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

use MetzWeb\Instagram\Instagram;

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
     * @return \MetzWeb\Instagram\Instagram
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
        if (!array_key_exists('client_id', $config)) {
            throw new \InvalidArgumentException('The Instagram client requires configuration.');
        }

        return array_only($config, ['client_id', 'client_secret', 'callback_url']);
    }

    /**
     * Get the pusher client.
     *
     * @param string[] $auth
     *
     * @return \Pusher
     */
    protected function getClient(array $auth)
    {
        if ($auth['client_secret'] && $auth['callback_url']) {
            return new Instagram([
                'apiKey' => $auth['client_id'],
                'apiSecret' => $auth['client_secret'],
                'apiCallback' => $auth['callback_url'],
            ]);
        }

        return new Instagram($auth['client_id']);
    }
}
