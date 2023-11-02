<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Thank you for shopping with Savify, here is your order:
            </h1>
        </header>
        <form action="{{ route('place-order') }}" method="post">
            @csrf
            <div class="my-4">
                <label for="delivery_address" style="font-weight: bold;">Give us your address please:</label>
                <input type="text" name="delivery_address" id="delivery_address" required style="width: 100%; padding: 8px; border: 1px solid #ccc;">
            </div>
            <div class="my-4">
                <label for="delivery_date" style="font-weight: bold;">What is the best date (Within 3 days please):</label>
                <input type="date" name="delivery_date" id="delivery_date" required style="width: 100%; padding: 8px; border: 1px solid #ccc;">
            </div>
            <div class="my-4">
                <button type="submit" class="bg-black text-white py-2 px-4 rounded-full hover:opacity-80">
                    Place Order
                </button>
            </div>
        </form>
    </x-card>
</x-layout>
