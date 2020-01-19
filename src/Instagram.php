<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/instagram
 */

declare(strict_types=1);

namespace Vinkla\Instagram;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;

class Instagram
{
    protected string $accessToken;

    protected HttpClient $httpClient;

    protected RequestFactory $requestFactory;

    public function __construct(string $accessToken, ?HttpClient $httpClient = null, ?RequestFactory $requestFactory = null)
    {
        $this->accessToken = $accessToken;
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    public function media(array $parameters = []): array
    {
        $response = $this->get('users/self/media/recent', $parameters);

        return $response->data;
    }

    public function comments(string $mediaId): array
    {
        $response = $this->get('media/' . $mediaId . '/comments');

        return $response->data;
    }

    public function self(): object
    {
        $response = $this->get('users/self');

        return $response->data;
    }

    /**
     * @throws \Vinkla\Instagram\InstagramException
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

    protected function buildApiUrl(string $path, array $parameters): string
    {
        $parameters = array_merge([
            'access_token' => $this->accessToken,
        ], $parameters);

        $query = http_build_query($parameters, '', '&');

        return 'https://api.instagram.com/v1/' . $path . '?' . $query;
    }
}
