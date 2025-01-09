<?php

namespace App\Services\ChannelEngine;

use App\Contracts\MerchantApi;
use Illuminate\Support\Facades\Http;

class ChannelEngineMerchantApi implements MerchantApi
{
    public function getOrdersByStatus(array $statues = ['IN_PROGRESS'])
    {
        return Http::get($this->getBaseUrl() . '/orders', [
            'apiKey' => config('services.merchant_api.key'),
            'statuses' => $statues
        ])->object();
    }

    public function getTopTenProducts(int $limit = 5)
    {
        $orders = $this->getOrdersByStatus();

        $topProducts = array();

        foreach ($orders->Content as $order) {
            $lines = $order->Lines;

            foreach ($lines as $item) {

                if (!key_exists($item->Gtin, $topProducts)) {
                    
                    $topProducts[$item->Gtin] = [
                        "productName" => $item->Description,
                        "gtin" => $item->Gtin,
                        "count" => 1
                    ];
                } else {
                    $topProducts[$item->Gtin]['count']++;
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
