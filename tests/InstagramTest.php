<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Instagram;

use PHPUnit\Framework\TestCase;
use Vinkla\Instagram\Instagram;
use Vinkla\Instagram\InstagramException;

/**
 * This is the instagram test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramTest extends TestCase
{
    public function testGet()
    {
        $items = (new Instagram())->get('jerryseinfeld');

        $this->assertInternalType('array', $items);
        $this->assertCount(20, $items);
    }

    public function testNotFound()
    {
        $this->expectException(InstagramException::class);

        (new Instagram())->get('imspeechlessihavenospeech');
    }
}
