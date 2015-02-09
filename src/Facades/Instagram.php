<?php

namespace Vinkla\Instagram\Facades;

use Illuminate\Support\Facades\Facade;

class Instagram extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'instagram';
	}
}
