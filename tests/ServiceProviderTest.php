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

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Larabros\Elogram\Client;
use Vinkla\Instagram\InstagramFactory;
use Vinkla\Instagram\InstagramManager;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testInstagramFactoryIsInjectable()
    {
        $this->assertIsInjectable(InstagramFactory::class);
    }

    public function testInstagramManagerIsInjectable()
    {
        $this->assertIsInjectable(InstagramManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['instagram.connection'];
        $this->app['instagram']->reconnect();
        $new = $this->app['instagram.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
