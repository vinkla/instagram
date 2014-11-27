<?php namespace Vinkla\Instagram;

use Illuminate\Support\ServiceProvider;

class InstagramServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register 'Instagram' instance container to our Instagram object.
		$this->app->bindShared('Vinkla\Instagram\Contracts\Instagram', function($app)
		{
			return new Instagram(
				$app['config']['instagram::client_id'],
				$app['config']['instagram::client_secret'],
				$app['config']['instagram::callback']
			);
		});
	}
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('vinkla/instagram');
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
