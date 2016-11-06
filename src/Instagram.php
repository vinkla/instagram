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

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Vinkla\Instagram\Exceptions\NotFoundException;

/**
 * This is the instagram class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class Instagram
{
    /**
     * The guzzle http client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Create a new instagram instance.
     *
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @return void
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * Fetch the media items.
     *
     * @param string $user
     *
     * @throws \Vinkla\Instagram\Exceptions\NotFoundException
     *
     * @return array
     */
    public function get(string $user): array
    {
        try {
            $url = sprintf('https://www.instagram.com/%s/media', $user);

            $response = $this->client->get($url);

            return json_decode((string) $response->getBody(), true)['items'];
        } catch (RequestException $e) {
            throw new NotFoundException(sprintf('The user [%s] was not found.', $user));
        }
    }
}
