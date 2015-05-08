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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the Instagram service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/instagram.php');

        $this->publishes([$source => config_path('instagram.php')]);

        $this->mergeConfigFrom($source, 'instagram');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('instagram.factory', function () {
            return new Factories\InstagramFactory();
        });

        $app->alias('instagram.factory', 'Vinkla\Instagram\Factories\InstagramFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('instagram', function ($app) {
            $config = $app['config'];
            $factory = $app['instagram.factory'];

            return new InstagramManager($config, $factory);
        });

        $app->alias('instagram', 'Vinkla\Instagram\InstagramManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'instagram',
            'instagram.factory',
        ];
    }
}
