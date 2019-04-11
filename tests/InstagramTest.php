<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
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
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class InstagramTest extends TestCase
{
    public function testMedia()
    {
        $response = new Response(200, [], json_encode([
            'data' => range(0, 19),
            'meta' => [],
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $items = $instagram->media();

        $this->assertIsArray($items);
        $this->assertCount(20, $items);
    }

    public function testCanAppendParametersToMedia()
    {
        $response = new Response(200, [], json_encode([
            'data' => [],
            'meta' => [],
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $instagram->media([
            'count' => 22,
            'min_id' => 'min id',
            'max_id' => 'max id',
        ]);

        $request = $client->getLastRequest();

        $this->assertSame(
            'access_token=jerryseinfeld&count=22&min_id=min+id&max_id=max+id',
            $request->getUri()->getQuery()
        );
    }

    public function testSelf()
    {
        $response = new Response(200, [], json_encode([
            'data' => ['id' => rand(1, 100000)],
            'meta' => [],
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $user = $instagram->self();

        $this->assertIsObject($user);
    }

    public function testComments()
    {
        $response = new Response(200, [], json_encode([
            'data' => range(1, 5),
            'meta' => [],
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $comments = $instagram->comments('media-id');

        $this->assertIsArray($comments);
    }

    public function testError()
    {
        $this->expectException(InstagramException::class);
        $this->expectExceptionMessage('The access_token provided is invalid.');

        (new Instagram('imspeechlessihavenospeech'))->media();
    }

    public function testHttpError()
    {
        $this->expectException(InstagramException::class);
        $this->expectExceptionMessage('No server is available for the request');

        $response = new Response(503, [], null, null, 'No server is available for the request');

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $user = $instagram->self();
    }
}
