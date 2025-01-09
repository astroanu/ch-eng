<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ChannelEngine\ChannelEngineMerchantApi;
use Illuminate\Support\Facades\Http;

class ChannelEngineMerchantApiTest extends TestCase
{
    public function test_service_returns_top_ten_products(): void
    {
        Http::fake([
            'https://api.channelengine.test/*' => Http::response(file_get_contents(__DIR__ . '/../../../fixtures/orders.json'), 200),
        ]);

        $underTest = new ChannelEngineMerchantApi();

        $result = $underTest->getTopTenProducts();

        $this->assertEquals([
            [
                "productName" => "Skorowidz TOP-2000 Color A5 96 kartek w kratkę, Niebieski",
                "gtin" => "5904017377016",
                "count" => 3
            ],
            [
                "productName" => "KALENDARZ TRÓJDZIELNY 2025 TOP 2000 MIX 31X70,5 CM",
                "gtin" => "5901466243596",
                "count" => 1
            ],
            [
                "productName" => "Valma 1830572 W21 Rubber Stick 38 ml",
                "gtin" => "8711165557089",
                "count" => 1
            ],
            [
                "productName" => "Valma 1830572 W21 Rubber Stick 38 ml",
                "gtin" => "8714165517089",
                "count" => 1
            ]
        ], $result);
    }
}
