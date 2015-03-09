<?php

namespace Vinkla\Instagram\Factories;

use MetzWeb\Instagram\Instagram;

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
     * @return string
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('client_id', $config)) {
            throw new \InvalidArgumentException('The Instagram client requires authentication.');
        }

        return array_only($config, ['client_id', 'client_secret', 'callback_url']);
    }
}
