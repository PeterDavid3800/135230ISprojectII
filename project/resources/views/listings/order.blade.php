<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Your Order:
            </h1>
        </header>
        <form action="{{ route('place-order') }}" method="post">
            @csrf
            <div class="my-4">
                <label for="delivery_address">Delivery Address:</label>
                <input type="text" name="delivery_address" id="delivery_address" required>
            </div>
            <div class="my-4">
                <label for="delivery_date">Delivery Date:</label>
                <input type="date" name="delivery_date" id="delivery_date" required>
            </div>
            <div class="my-4">
                <button type="submit" class="bg-black text-white py-2 px-4 rounded-full hover:opacity-80">
                    Place Order
                </button>
            </div>
        </form>
    </x-card>
</x-layout>
