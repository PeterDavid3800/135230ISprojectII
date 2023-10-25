<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    //Show all orders made
    public function orders(Order $orders)
{
    return view('orders.orders');
}

}
