<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class TopTenProductsTest extends TestCase
{
    public function test_save_stock_update(): void
    {
        // Arrange
        $this->mockHttpResponse('/offer/stock', 'update-stock.json', 200);

        // Act
        $response = $this->post('/update-stock/123-test-merchant-id', [
            "stockLocationId" => 6,
            "stockAmount" => 12,
        ]);

        // Assert
        $response->assertRedirect('/');
    }

    public function test_display_stock_update(): void
    {
        // Act
        $response = $this->get('/update-stock/123-test-merchant-id');

        // Assert
        $response->assertStatus(200);
    }

    public function test_display_top_ten_products(): void
    {
        // Arrange
        $this->mockHttpResponse('/orders', 'orders.json', 200);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
    }
}
