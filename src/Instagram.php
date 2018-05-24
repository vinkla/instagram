<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Instagram;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;

/**
 * This is the instagram class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Instagram
{
    /**
     * The access token.
     *
     * @var string
     */
    protected $accessToken;

    /**
     * The http client.
     *
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * The http request factory.
     *
     * @var \Http\Message\RequestFactory
     */
    protected $requestFactory;

    /**
     * The http request.
     *
     * @var string
     */
    protected $request;

    /**
     * Create a new instagram instance.
     *
     * @param string $accessToken
     * @param \Http\Client\HttpClient|null $httpClient
     * @param \Http\Message\RequestFactory|null $requestFactory
     *
     * @return void
     */
    public function __construct(string $accessToken, HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->accessToken = $accessToken;
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * Fetch recent user media items.
     *
     * @return array
     */
    public function media(): array
    {
        $response = $this->get('users/self/media/recent');

        return $response->data;
    }

    /**
     * Fetch user information.
     *
     * @return object
     */
    public function self(): object
    {
        $response = $this->get('users/self');

        return $response->data;
    }

    /**
     * Send a get request.
     *
     * @param string $path
     *
     * @throws \Vinkla\Instagram\InstagramException
     *
     * @return object
     */
    protected function get(string $path): object
    {
        $url = sprintf('https://api.instagram.com/v1/%s?access_token=%s', $path, $this->accessToken);

        $request = $this->requestFactory->createRequest('GET', $url);
        $response = $this->httpClient->sendRequest($request);

        $body = json_decode((string) $response->getBody());

        if (isset($body->meta->error_message)) {
            throw new InstagramException($body->meta->error_message);
        }

        return $body;
    }
}
