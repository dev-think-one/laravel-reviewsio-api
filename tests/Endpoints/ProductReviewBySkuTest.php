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
    }
}
