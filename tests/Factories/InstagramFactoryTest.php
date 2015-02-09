<?php

namespace Vinkla\Tests\Instagram\Factories;

use Vinkla\Instagram\Factories\InstagramFactory;
use Vinkla\Tests\Instagram\AbstractTestCase;

class InstagramFactoryTest extends AbstractTestCase
{
	public function testMakeStandard()
	{
		$factory = $this->getInstagramFactory();

		$return = $factory->make([
			'client_id' => 'your-client-id',
			'client_secret' => null,
			'callback_url' => null
		]);

		$this->assertInstanceOf('MetzWeb\Instagram\Instagram', $return);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testMakeWithoutClientId()
	{
		$factory = $this->getInstagramFactory();

		$factory->make([]);
	}

	protected function getInstagramFactory()
	{
		return new InstagramFactory();
	}
}
