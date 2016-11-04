<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * The username string.
     *
     * @var string
     */
    protected $user;

    /**
     * The guzzle http client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Create a new instagram instance.
     *
     * @param string $user
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @return void
     */
    public function __construct(string $user, ClientInterface $client = null)
    {
        $this->user = $user;
        $this->client = $client ?: new Client();
    }

    /**
     * Fetch the instagram media feed.
     *
     * @throws \Vinkla\Instagram\Exceptions\NotFoundException
     *
     * @return object
     */
    public function get()
    {
        try {
            $url = sprintf('https://www.instagram.com/%s/media', $this->user);

            $response = $this->client->get($url);

            return json_decode((string) $response->getBody());
        } catch (RequestException $e) {
            throw new NotFoundException(sprintf('The user [%s] was not found.', $this->user));
        }
    }
}
