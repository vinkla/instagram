<?php

/*
 * This file is part of Laravel Instagram.
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

/**
 * This is the instagram test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class InstagramTest extends TestCase
{
    public function testGet()
    {
        $instagram = new Instagram();

        $items = $instagram->get('jerryseinfeld');

        die(var_dump($items));

        $this->assertInternalType('array', $items);
        $this->assertCount(20, $items);
    }

    /**
     * @expectedException \Vinkla\Instagram\InstagramException
     */
    public function testNotFound()
    {
        (new Instagram())->get('imspeechlessihavenospeech');
    }
}
