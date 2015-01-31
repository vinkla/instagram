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
		$source = sprintf('%s/../../config/instagram.php', __DIR__);

		$this->publishes([$source => config_path('instagram.php')]);

		$this->mergeConfigFrom($source, 'instagram.php');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('Vinkla\Instagram\Contracts\Instagram', function()
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
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['Vinkla\Instagram\Contracts\Instagram'];
	}

}
