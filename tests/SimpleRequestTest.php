<?php

namespace Reviewsio\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Reviewsio\Facades\Reviewsio;

class SimpleRequestTest extends TestCase
{
    /** @test */
    public function request()
    {
        Http::fake(function (Request $request) {
            $this->assertEquals(json_encode(['foo' => 'bar',]), $request->body());
            $this->assertEquals('https://api.reviews.io/my-url', $request->url());
            $this->assertEquals('POST', $request->method());

            return Http::response([
                'test' => 'baz',
            ], 200);
        });

        $response = Reviewsio::api()
            ->simpleRequest()
            ->call([
                /* method */ 'post',
                /* url */ 'my-url',
                /* options */ [
                    'json' => [
                        'foo' => 'bar',
                    ],
                ],
            ], [
                'guzzle' => [
                    'timeout' => 10,
                ],
                'headers' => [
                    'X-Foo-Bar' => 'baz',
                ],
            ]);

        $this->assertEquals('baz', $response->json('test'));
    }
}
