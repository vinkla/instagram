<?php namespace Vinkla\Tests\Instagram;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;
use Vinkla\Instagram\InstagramManager;

class InstagramManagerTest extends AbstractTestBenchTestCase {

	public function testCreateConnection()
	{
		$config = ['path' => __DIR__];

		$manager = $this->getManager($config);

		$manager->getConfig()->shouldReceive('get')->once()
			->with('instagram.default')->andReturn('instagram');

		$this->assertSame([], $manager->getConnections());

		$return = $manager->connection();

		$this->assertInstanceOf('MetzWeb\Instagram\Instagram', $return);

		$this->assertArrayHasKey('instagram', $manager->getConnections());
	}

	protected function getManager(array $config)
	{
		$repository = Mockery::mock('Illuminate\Contracts\Config\Repository');
		$factory = Mockery::mock('Vinkla\Instagram\Factories\InstagramFactory');

		$manager = new InstagramManager($repository, $factory);

		$manager->getConfig()->shouldReceive('get')->once()
			->with('instagram.connections')->andReturn(['instagram' => $config]);

		$config['name'] = 'instagram';

		$manager->getFactory()->shouldReceive('make')->once()
			->with($config)->andReturn(Mockery::mock('MetzWeb\Instagram\Instagram'));

		return $manager;
	}

}
