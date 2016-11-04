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

use PHPUnit\Framework\TestCase;
use Vinkla\Instagram\Instagram;

/**
 * This is the instagram test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramTest extends TestCase
{
    public function testGet()
    {
        $response = (new Instagram('jerryseinfeld'))->get();

        $this->assertObjectHasAttribute('status', $response);
        $this->assertSame('ok', $response->status);
    }

    /**
     * @expectedException \Vinkla\Instagram\Exceptions\NotFoundException
     */
    public function testNotFound()
    {
        (new Instagram('imspeechlessihavenospeech'))->get();
    }
}
