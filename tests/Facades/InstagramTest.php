<?php namespace Vinkla\Tests\Instagram\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use Vinkla\Tests\Instagram\AbstractTestCase;

class InstagramTest extends AbstractTestCase {

	use FacadeTestCaseTrait;

	/**
	 * Get the facade accessor.
	 *
	 * @return string
	 */
	protected function getFacadeAccessor()
	{
		return 'instagram';
	}

	/**
	 * Get the facade class.
	 *
	 * @return string
	 */
	protected function getFacadeClass()
	{
		return 'Vinkla\Instagram\Facades\Instagram';
	}

	/**
	 * Get the facade route.
	 *
	 * @return string
	 */
	protected function getFacadeRoot()
	{
		return 'Vinkla\Instagram\InstagramManager';
	}

}
