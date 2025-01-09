<?php

namespace App\Contracts;

interface MerchantApi {
    public function getOrdersByStatus(array $statues = []);
    public function getTopTenProducts();
}