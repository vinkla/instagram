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

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
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
    public function testMedia()
    {
        $response = new Response(200, [], json_encode([
            'data' => range(0, 19),
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $items = $instagram->media();

        $this->assertInternalType('array', $items);
        $this->assertCount(20, $items);
    }

    public function testSelf()
    {
        $response = new Response(200, [], json_encode([
            'data' => [
                'id' => rand(1, 100000),
            ],
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $user = $instagram->self();

        $this->assertInternalType('object', $user);
    }

    public function testError()
    {
        $this->expectException(InstagramException::class);
        $this->expectExceptionMessage('The access_token provided is invalid.');

        (new Instagram('imspeechlessihavenospeech'))->media();
    }
}
