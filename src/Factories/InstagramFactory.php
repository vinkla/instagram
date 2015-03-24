<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Instagram\Factories;

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
     * @return Instagram
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        if ($config['client_secret'] && $config['callback_url']) {
            return new Instagram([
                'apiKey' => $config['client_id'],
                'apiSecret' => $config['client_secret'],
                'apiCallback' => $config['callback_url']
            ]);
        }

        return new Instagram($config['client_id']);
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
}
