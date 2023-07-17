<?php

namespace Reviewsio\Tests\Endpoints;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Reviewsio\Facades\Reviewsio;
use Reviewsio\Tests\TestCase;

class ProductReviewBySkuTest extends TestCase
{
    /** @test */
    public function request()
    {
        Http::fake(function (Request $request) {
            $this->assertStringNotContainsString('sku', $request->url());

            return Http::response([
                'store' => [
                    'name' => 'Demo Store',
                    'logo' => 'https://s3-eu-west-1.amazonaws.com/reviewscouk/assets/demo-16648/demo-logo.png',
                ],
                'stats' => [
                    'average' => '4.7',
                    'count'   => '6',
                ],
                'reviews' => [
                    'total'        => '1',
                    'per_page'     => '15',
                    'current_page' => '1',
                    'last_page'    => '2',
                    'from'         => '1',
                    'to'           => '3',
                    'data'         => [
                        [
                            'review'       => 'Great product, use it everynight.',
                            'sku'          => '1234',
                            'rating'       => '4',
                            'date_created' => '2016-02-27 15:53:59',
                            'reviewer'     => [
                                'first_name'     => 'Mavis',
                                'last_name'      => 'Beacon',
                                'verified_buyer' => 'yes',
                            ],
                            'product' => [
                                'sku'         => '1234',
                                'name'        => 'Amazon Kindle Paperwhite',
                                'description' => 'E-Reader',
                                'image_url'   => 'http://www.testshop.com/image/test.jpg',
                                'mpn'         => '1445',
                                'brand'       => 'amazon',
                                'category'    => 'tablets',
                            ],
                        ],
                    ],
                ],
            ], 200);
        });

        $response = Reviewsio::api()
            ->productReviewBySku()
            ->sku('The Reach')
            ->removeParameterFromQuery('sku')
            ->paginate()
            ->call([
                'minRating' => 2,
            ]);

        $this->assertEquals(1, $response->total());
        $this->assertCount(1, $response->reviews());
        $this->assertEquals(15, $response->perPage());
        $this->assertEquals(1, $response->from());
        $this->assertEquals(3, $response->to());
        $this->assertEquals(1, $response->currentPage());
        $this->assertEquals(2, $response->lastPage());
        $this->assertEquals('1234', $response->baseResponse()->json('reviews.data.0.sku'));
        $this->assertEquals('1234', $response->reviews()->first()['sku']);

        $this->assertEquals('Demo Store', $response->storeName());
        $this->assertEquals('https://s3-eu-west-1.amazonaws.com/reviewscouk/assets/demo-16648/demo-logo.png', $response->storeLogo());
        $this->assertEquals(4.7, $response->averageRating());
        $this->assertEquals(6, $response->count());
    }

    /** @test */
    public function request_change_store()
    {
        Http::fake(function (Request $request) {
            $this->assertStringContainsString('mpn=qux', $request->url());
            $this->assertStringContainsString('store=Other%20store', $request->url());
            $this->assertStringContainsString('sku=The%20Reach', $request->url());
            $this->assertStringContainsString('minRating=2', $request->url());

            return Http::response([
                'store' => [
                    'name' => 'Demo Store',
                    'logo' => 'https://s3-eu-west-1.amazonaws.com/reviewscouk/assets/demo-16648/demo-logo.png',
                ],
                'stats' => [
                    'average' => '4.7',
                    'count'   => '6',
                ],
                'reviews' => [
                    'total'        => '1',
                    'per_page'     => '15',
                    'current_page' => '1',
                    'last_page'    => '2',
                    'from'         => '1',
                    'to'           => '3',
                    'data'         => [
                        [
                            'review'       => 'Great product, use it everynight.',
                            'sku'          => '1234',
                            'rating'       => '4',
                            'date_created' => '2016-02-27 15:53:59',
                            'reviewer'     => [
                                'first_name'     => 'Mavis',
                                'last_name'      => 'Beacon',
                                'verified_buyer' => 'yes',
                            ],
                            'product' => [
                                'sku'         => '1234',
                                'name'        => 'Amazon Kindle Paperwhite',
                                'description' => 'E-Reader',
                                'image_url'   => 'http://www.testshop.com/image/test.jpg',
                                'mpn'         => '1445',
                                'brand'       => 'amazon',
                                'category'    => 'tablets',
                            ],
                        ],
                    ],
                ],
            ], 200);
        });

        $response = Reviewsio::api()
            ->productReviewBySku()
            ->store('Other store')
            ->mpn('qux')
            ->sku('The Reach')
            ->paginate()
            ->call([
                'minRating' => 2,
            ]);


    }
}
