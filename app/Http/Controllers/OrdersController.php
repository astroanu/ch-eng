<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function show(Request $request):View{
        return view('orders.list',[]);
    }
}
