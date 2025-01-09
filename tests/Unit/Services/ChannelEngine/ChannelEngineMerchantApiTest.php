<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ChannelEngine\ChannelEngineMerchantApi;
use Illuminate\Support\Facades\Http;

class ChannelEngineMerchantApiTest extends TestCase
{

    public function test_service_updates_stock_success(): void
    {
        $httpMock = Http::fake([
            'https://api.channelengine.test/api/v2/offer/stock*' => Http::response(file_get_contents(__DIR__ . '/../../../fixtures/update-stock.json'), 200),
        ]);

        $underTest = new ChannelEngineMerchantApi();

        $result = $underTest->updateStock('123456789', 2, 25);

        $httpMock->assertSent(function ($request) {
            return $request->url() == 'https://api.channelengine.test/api/v2/offer/stock?apiKey=API_KEY';
        });

        $this->assertEquals($result->StatusCode, 200);
    }

    public function test_service_returns_top_ten_products(): void
    {
        $httpMock = Http::fake([
            'https://api.channelengine.test/api/v2/orders*' => Http::response(file_get_contents(__DIR__ . '/../../../fixtures/orders.json'), 200),
        ]);

        $underTest = new ChannelEngineMerchantApi();

        $result = $underTest->getTopTenProducts();

        $httpMock->assertSent(function ($request) {
            return $request['apiKey'] == 'API_KEY';
        });

        $this->assertEquals([
            [
                "productName" => "Skorowidz TOP-2000 Color A5 96 kartek w kratkę, Niebieski",
                "gtin" => "5904017377016",
                "count" => 2,
                "merchantProductNumber" => "PROD_SKU_ZESZ_SKOROWIDZ_1"
            ],
            [
                "productName" => "KALENDARZ TRÓJDZIELNY 2025 TOP 2000 MIX 31X70,5 CM",
                "gtin" => "5901466243596",
                "count" => 1,
                "merchantProductNumber" => "PROD_SKU_KALENDARZ_111"
            ],
            [
                "productName" => "Valma 1830572 W21 Rubber Stick 38 ml",
                "gtin" => "8711165557089",
                "count" => 2,
                "merchantProductNumber" => "W21"
            ],
            [
                "productName" => "string",
                "gtin" => "5904017377016",
                "count" => 1,
                "merchantProductNumber" => "test-product-123456"
            ]
        ], $result);
    }
}
