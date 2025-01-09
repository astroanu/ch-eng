<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class TopTenProductsTest extends TestCase
{
    public function test_save_stock_update(): void
    {
        Http::fake([
            'https://api.channelengine.test/api/v2/offer/stock*' => Http::response(file_get_contents(__DIR__ . '/../fixtures/orders.json'), 200),
        ]);

        $response = $this->post('/update-stock/123-test-merchant-id', [
            "stockLocationId" => 6,
            "stockAmount" => 12,
        ]);

        $response->assertRedirect('/');
    }

    public function test_display_stock_update(): void
    {
        $response = $this->get('/update-stock/123-test-merchant-id');

        $response->assertStatus(200);
    }

    public function test_display_top_ten_products(): void
    {
        Http::fake([
            'https://api.channelengine.test/api/v2/orders*' => Http::response(file_get_contents(__DIR__ . '/../fixtures/orders.json'), 200),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
