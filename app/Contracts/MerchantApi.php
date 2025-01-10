<?php

namespace App\Contracts;

interface MerchantApi
{
    public function getOrdersByStatus(array $statues);

    public function getTopProducts();

    public function updateStock(string $merchantProductNumber, int $stockLocationId, int $stockAmount);
}
