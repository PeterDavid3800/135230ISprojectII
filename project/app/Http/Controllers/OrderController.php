<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Listing; // Import the Listing model

class OrderController extends Controller
{
    // Show all orders made
    public function orders(Order $order)
    {
        // Retrieve the associated listing information for each order
        $listings = Listing::whereIn('id', $order->pluck('listings_id'))->get();

        return view('orders.orders', ['order' => $order, 'listings' => $listings]);
    }

    // To handle order requests
    public function placeOrder(Request $request)
    {
        $listingId = $request->input('listings_id'); // Assuming you pass the listing ID in the request

        // Create a new order
        $order = new Order();
        $order->listings_id = $listingId;
        $order->user_id = auth()->user()->id; // Assuming you're using user authentication
        $order->save();

        // Optionally, you can perform additional actions here, such as sending confirmation emails or notifications.

        return redirect()->back()->with('success', 'Order placed successfully');
    }
}
