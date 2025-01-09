<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class DisplayTopTenProductsTest extends TestCase
{
    public function test_display_top_ten_products(): void
    {
        Http::fake([
            'https://api.channelengine.test/*' => Http::response(file_get_contents(__DIR__ . '/../fixtures/orders.json'), 200),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
