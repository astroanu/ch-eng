<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Contracts\MerchantApi;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function __construct(protected MerchantApi $merchant) {}

    public function showTopTenProducts(Request $request): View
    {
        $topTenProducts = $this->merchant->getTopTenProducts();

        return view('orders.list', ['topProducts' => $topTenProducts]);
    }

    public function showUpdateStock(Request $request): View
    {
        return view('orders.update', ['merchantProductNumber' => $request->route()->parameters['merchantProductNumber']]);
    }

    public function updateStock(Request $request)
    {
        $request->validate([
            'stockLocationId' => 'required|numeric',
            'stockAmount' => 'required|numeric',
        ]);

        $result = $this->merchant->updateStock(
            $request->route()->parameters['merchantProductNumber'],
            $request->integer('stockLocationId'),
            $request->integer('stockAmount')
        );

        if ($result->StatusCode == 200) {
            return redirect('/')->with('success', 'Stock updated!');
        }

        return redirect('/')->with('error', 'Stock updated failed!');
    }
}
