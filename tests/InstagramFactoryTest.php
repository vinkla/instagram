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

use Larabros\Elogram\Client;
use Vinkla\Instagram\InstagramFactory;

/**
 * This is the Instagram factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getInstagramFactory();

        $return = $factory->make([
            'id' => 'your-client-id',
            'secret' => 'your-client-secret',
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutId()
    {
        $factory = $this->getInstagramFactory();

        $factory->make([
            'secret' => 'your-client-secret',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getInstagramFactory();

        $factory->make([
            'id' => 'your-client-id',
        ]);
    }

    protected function getInstagramFactory()
    {
        return new InstagramFactory();
    }
}
