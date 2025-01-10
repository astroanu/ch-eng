<?php

namespace App\Services\ChannelEngine;

use App\Contracts\MerchantApi;
use Illuminate\Support\Facades\Http;

class ChannelEngineMerchantApi implements MerchantApi
{
    public function getOrdersByStatus(array $statues)
    {
        return Http::get($this->getBaseUrl() . '/orders', [
            'apiKey' => config('services.merchant_api.key'),
            'statuses' => $statues
        ])->object();
    }

    public function updateStock(string $merchantProductNumber, int $stockLocationId, int $stockAmount)
    {
        return Http::put($this->getBaseUrl() . '/offer/stock?' . 'apiKey=' . config('services.merchant_api.key'), [
            [
                "MerchantProductNo" => $merchantProductNumber,
                "StockLocations" => [
                    [
                        "Stock" => $stockAmount,
                        "StockLocationId" => $stockLocationId
                    ]
                ]
            ]
        ])->object();
    }

    public function getTopProducts(int $limit = 5)
    {
        $orders = $this->getOrdersByStatus(['IN_PROGRESS']);

        $topProducts = array();

        // Loop through each order and count the line items by the MerchantProductNo
        foreach ($orders->Content as $order) {
            $lines = $order->Lines;

            foreach ($lines as $item) {

                if (!key_exists($item->MerchantProductNo, $topProducts)) {

                    $topProducts[$item->MerchantProductNo] = [
                        "productName" => $item->Description,
                        "gtin" => $item->Gtin,
                        "count" => 1,
                        "merchantProductNumber" => $item->MerchantProductNo,
                    ];
                } else {
                    $topProducts[$item->MerchantProductNo]['count']++;
                }
            }
        }

        return collect(array_values($topProducts))->sortByDesc('count')->take($limit)->all();
    }

    private function getBaseUrl()
    {
        return config('services.merchant_api.base_url') . '/api/v2';
    }
}
