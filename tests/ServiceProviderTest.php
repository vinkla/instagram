<?php

namespace Vinkla\Tests\Instagram;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

class ServiceProviderTest extends AbstractTestCase
{
	use ServiceProviderTestCaseTrait;

	public function testInstagramFactoryIsInjectable()
	{
		$this->assertIsInjectable('Vinkla\Instagram\Factories\InstagramFactory');
	}

	public function testInstagramManagerIsInjectable()
	{
		$this->assertIsInjectable('Vinkla\Instagram\InstagramManager');
	}
}
