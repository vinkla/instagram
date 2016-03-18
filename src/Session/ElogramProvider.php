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

use Illuminate\Foundation\Application;
use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * This is the Instagram service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ElogramProvider extends AbstractServiceProvider
{
    /**
     * The provides array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        SessionStore::class,
    ];

    /**
     * Use the register method to register items with the container via the
     * protected ``$this->container`` property or the ``getContainer`` method
     * from the ``ContainerAwareTrait``.
     *
     * @return void
     */
    public function register()
    {
        $container = $this->getContainer();

        $container->share(SessionStore::class, function () use ($config) {
            $app = Application::getInstance();
            return new SessionStore($app->make('session.store'));
        });
    }
}
