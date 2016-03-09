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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the Instagram manager class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Vinkla\Instagram\InstagramFactory
     */
    private $factory;

    /**
     * Create a new Instagram manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\Instagram\InstagramFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, InstagramFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'instagram';
    }

    /**
     * Get the factory instance.
     *
     * @return \Vinkla\Instagram\InstagramFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
