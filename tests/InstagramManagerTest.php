<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Instagram;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Larabros\Elogram\Client;
use Mockery;
use Vinkla\Instagram\InstagramFactory;
use Vinkla\Instagram\InstagramManager;

/**
 * This is the Instagram manager test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('instagram.default')->andReturn('instagram');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Client::class, $return);

        $this->assertArrayHasKey('instagram', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(InstagramFactory::class);

        $manager = new InstagramManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('instagram.connections')->andReturn(['instagram' => $config]);

        $config['name'] = 'instagram';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(new Client('id', 'secret'));

        return $manager;
    }
}
