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

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
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
