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

use Illuminate\Contracts\Container\Container as Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use MetzWeb\Instagram\Instagram;

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
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/instagram.php');

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('instagram.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('instagram');
        }

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
        $this->registerBindings($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('instagram.factory', function () {
            return new InstagramFactory();
        });

        $app->alias('instagram.factory', InstagramFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
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

        $app->alias('instagram', InstagramManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('instagram.connection', function ($app) {
            $manager = $app['instagram'];

            return $manager->connection();
        });

        $app->alias('instagram.connection', Instagram::class);
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
            'instagram.connection',
        ];
    }
}
