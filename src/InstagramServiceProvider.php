<?php namespace Vinkla\Instagram;

use Illuminate\Support\ServiceProvider;

class InstagramServiceProvider extends ServiceProvider {

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
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
		$this->app->singleton('instagram', function()
		{
			if (!config('instagram.client_secret') && !config('instagram.callback_url'))
			{
				return new Instagram(config('instagram.client_id'));
			}

			return new Instagram([
				'apiKey' => config('instagram.client_id'),
				'apiSecret' => config('instagram.client_secret'),
				'apiCallback' => config('instagram.callback_url')
			]);
		});

		$this->app->alias('instagram', 'Vinkla\Instagram\Instagram');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['instagram'];
	}

}
