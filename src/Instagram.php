<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
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
 * @author Vincent Klaiber <hello@doubledip.se>
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
     * @param array $parameters
     *
     * @return array
     */
    public function media(array $parameters = []): array
    {
        $response = $this->get('users/self/media/recent', $parameters);

        return $response->data;
    }

    /**
     * Fetch comments from media item.
     *
     * @param string $mediaId
     *
     * @return array
     */
    public function comments(string $mediaId): array
    {
        $response = $this->get('media/' . $mediaId . '/comments');

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
     * @param array $parameters
     *
     * @throws \Vinkla\Instagram\InstagramException
     *
     * @return object
     */
    protected function get(string $path, array $parameters = []): object
    {
        $url = $this->buildApiUrl($path, $parameters);

        $request = $this->requestFactory->createRequest('GET', $url);
        $response = $this->httpClient->sendRequest($request);

        $body = json_decode((string) $response->getBody());

        if (isset($body->error_message)) {
            throw new InstagramException($body->error_message);
        }

        if (isset($body->meta->error_message)) {
            throw new InstagramException($body->meta->error_message);
        }

        if ($response->getStatusCode() !== 200) {
            throw new InstagramException($response->getReasonPhrase());
        }

        return $body;
    }

    /**
     * Add access token and escape parameters.
     *
     * @param string $path
     * @param array $parameters
     *
     * @return string
     */
    protected function buildApiUrl(string $path, array $parameters): string
    {
        $parameters = array_merge([
            'access_token' => $this->accessToken,
        ], $parameters);

        $query = http_build_query($parameters, '', '&');

        return 'https://api.instagram.com/v1/' . $path . '?' . $query;
    }
}
