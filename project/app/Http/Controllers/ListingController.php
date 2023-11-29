<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use PDF;



class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(5)
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'oldPrice' => 'required',
            'newPrice' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        // Check if the user is an admin or the owner of the listing
    if (auth()->user()->role === 'admin' || $listing->user_id == auth()->id()) {
        return view('listings.edit', ['listing' => $listing]);
    } else {
        abort(403, 'Unauthorized Action');
    }
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'oldPrice' => 'required',
            'newPrice' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    
    // Delete Listing
    public function destroy(Listing $listing) {
        // Check if the logged-in user is authorized to delete the listing
        if ($listing->user_id != auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
    
        // Retrieve the related cart items
       $cartItems = CartItem::where('listing_id', $listing->id)->get();
    
       // Detach the cart items from the listing
       $listing->cartItems->each(function ($cartItem) {
           $cartItem->delete();
       });
       
       // Now you can safely delete the listing
       if ($listing->logo && Storage::disk('public')->exists($listing->logo)) {
           Storage::disk('public')->delete($listing->logo);
       }
       $listing->delete();
    
        return redirect('/')->with('message', 'Listing deleted successfully');
    }
    
    
       // Manage Listings
       public function manage() 
{
    if (auth()->user()->role === 'admin') {
        // If the user has an 'admin' role, retrieve all listings
        $listings = Listing::all();
    } else {
        // For other users, retrieve their own listings
        $listings = auth()->user()->listings()->get();
    }
    return view('listings.manage', ['listings' => $listings]);
}

    public function cart()
      {
        return view('listings.cart', ['listings' => auth()->user()->listings()->get()]);
      }

public function addToCart(Request $request, Listing $listing) {
    $user = auth()->user();
    $quantity = $request->input('quantity', 1); // I can modify this as needed.

    // Check if the item is already in the cart for the user, and update the quantity if so.
    if ($user->cartItems->contains('listing_id', $listing->id)) {
        $user->cartItems->where('listing_id', $listing->id)->first()->update(['quantity' => $quantity]);
    } else {
        $user->cartItems()->create([
            'listing_id' => $listing->id,
            'quantity'=> $quantity,
        ]);

    }

    return back()->with('message', 'Item added to your cart');
}

public function removeFromCart(Request $request, Listing $listing) {
    auth()->user()->cartItems()->where('listing_id', $listing->id)->delete();
    return back()->with('message', 'Item removed from your cart');
}

public function showOrderForm()
{
    return view('listings.order');
}

public function placeOrder(Request $request)
{
      // Retrieve the user's cart items
      $cartItems = auth()->user()->cartItems;

      // Calculate the total price for the order
      $totalPrice = $cartItems->sum(function ($item) {
          return $item->listing->newPrice * $item->quantity;
      });
  
      // Define the delivery date (3 days from now)
      $deliveryDate = now()->addDays(3)->format('Y-m-d'); // Change the date format as needed
  
      // Get the delivery address provided by the user
      $deliveryAddress = $request->input('delivery_address'); // Replace with the actual input field name
  
      // ...
  
      $orderDetails = [
          'user_id' => auth()->user()->id, // User's ID
          'total_price' => $totalPrice, // Total price of the order
          'delivery_address' => $deliveryAddress, // Delivery address provided by the user
          'delivery_date' => $deliveryDate, // Delivery date (3 days from now)
          'items' => [], // An array to store individual items in the order
      ];
  
      // Iterate through the cart items to add each item to the 'items' array
      foreach ($cartItems as $cartItem) {
          $orderDetails['items'][] = [
              'listing_id' => $cartItem->listing->id,
              'title' => $cartItem->listing->title,
              'price' => $cartItem->listing->newPrice,
              'quantity' => $cartItem->quantity,
              'subtotal' => $cartItem->listing->newPrice * $cartItem->quantity,
          ];
      }
    
    // Optionally, you can save this order information to the database if needed
    // You can add more fields to the $orderDetails array if necessary
    

    // Retrieve the user's cart items
    $cartItems = auth()->user()->cartItems;

    // Calculate the total price for the order
    $totalPrice = $cartItems->sum(function ($item) {
        return $item->listing->newPrice * $item->quantity;
    });

    // Collect delivery information from the user
    $deliveryAddress = $request->input('delivery_address');
    $deliveryDate = $request->input('delivery_date');

    // Generate a delivery note or order summary
$deliveryNote = 'Your Order Summary:';
foreach ($cartItems as $cartItem) {
    $deliveryNote .= $cartItem->listing->title . ' x' . $cartItem->quantity . ': Kshs ' . ($cartItem->listing->newPrice * $cartItem->quantity) . "\n";
}
$deliveryNote .= 'Total Price: Kshs ' . $totalPrice . "\n";
$deliveryNote .= 'Delivery Date: ' . $deliveryDate . "\n";
$deliveryNote .= 'Delivery Address: ' . $deliveryAddress . "\n";

// Generate a PDF from the delivery note
$pdf = PDF::loadView('listings.delivery-note', ['deliveryNote' => $deliveryNote]);

// Send the PDF to the user's email
Mail::send('emails.order-confirmation', ['order' => $deliveryNote], function ($message) use ($pdf) {
    $message->to(auth()->user()->email)
            ->subject('Order Confirmation')
            ->attachData($pdf->output(), 'delivery-note.pdf');
});


    // Optionally, save the order and related information to the database

    // Redirect the user after placing the order
    return redirect('/')->with('message', 'Order placed successfully!');
}

public function generateTagChart()
{
    // Retrieve all cart items and associated listings
    $cartItems = CartItem::with('listing')->get();

    // Count tags
    $tagCounts = [];

    foreach ($cartItems as $cartItem) {
        $listingTags = $cartItem->listing->tagsArray;

        foreach ($listingTags as $tag) {
            if (isset($tagCounts[$tag])) {
                $tagCounts[$tag]++;
            } else {
                $tagCounts[$tag] = 1;
            }
        }
    }

    // Sort tags by count in descending order
    arsort($tagCounts);

    // Prepare data for the chart
    $chartData = [
        'labels' => array_keys($tagCounts),
        'data' => array_values($tagCounts),
    ];

    return view('chart', ['chartData' => $chartData]);
}

}
