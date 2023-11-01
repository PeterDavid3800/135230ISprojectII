<x-layout>
  <x-card class="p-10">
      <header>
          <h1 class="text-3xl text-center font-bold my-6 uppercase">
              Your Cart:
          </h1>
      </header>
      <table class="w-full table-auto rounded-sm">
          <tbody>
              @foreach(auth()->user()->cartItems as $cartItem)
                  <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="/listings/{{$cartItem->listing->id}}">
                            <img src="{{ asset('storage/' . $cartItem->listing->logo) }}" alt="Listing Logo" class="w-32">
                        </a>
                    </td>                    
                      <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                          <a href="/listings/{{$cartItem->listing->id}}">{{$cartItem->listing->title}}</a>
                      </td>
                      <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                          {{$cartItem->listing->newPrice}}
                      </td>
                      <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                          Quantity: {{$cartItem->quantity}}
                      </td>
                      <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                          <form method="POST" action="/listings/{{$cartItem->listing->id}}/remove-from-cart">
                              @csrf
                              @method('DELETE')
                              <button class="text-red-500"><i class="fa-solid fa-trash"></i> Remove</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      <div class="text-lg mt-4">
        Total Price: Kshs {{ auth()->user()->cartItems->sum(function($item) {
            return $item->listing->newPrice * $item->quantity;
        }) }}
    </div>
    <div>
      <a href="/listings/orders">
        <button type="submit" class="bg-black text-white py-2 px-4 rounded-full hover:opacity-80">
          Make Order
      </button>
    </a>
  </div>  
  </x-card>
</x-layout>
