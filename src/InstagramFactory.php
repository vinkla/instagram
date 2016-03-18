<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Instagram;

use InvalidArgumentException;
use Larabros\Elogram\Client;
use Vinkla\Instagram\Session\SessionStore;

/**
 * This is the Instagram factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramFactory
{
    /**
     * Make a new Instagram client.
     *
     * @param array $config
     *
     * @return \Larabros\Elogram\Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['id', 'secret'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['id', 'secret', 'access_token', 'redirect_url', 'options']);
    }

    /**
     * Get the Instagram client.
     *
     * @param string[] $auth
     *
     * @return \Larabros\Elogram\Client
     */
    protected function getClient(array $auth)
    {
        return new Client(
            array_get($auth, 'id'),
            array_get($auth, 'secret'),
            array_get($auth, 'access_token', null),
            array_get($auth, 'redirect_url', ''),
            array_get($auth, 'options', [
                'session_store' => SessionStore::class,
            ])
        );
    }
}
