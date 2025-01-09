<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Contracts\MerchantApi;

class OrdersController extends Controller
{
    public function __construct(protected MerchantApi $merchant) {}

    public function show(Request $request): View
    {
        $topTenProducts = $this->merchant->getTopTenProducts();

        return view('orders.list', ['topProducts' => $topTenProducts]);
    }
}
