<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
          <h2 class="text-2xl font-bold uppercase mb-1">Set Your Budget</h2>
        </header>
    <form method="POST" action="{{ route('budget.store') }}">
        @csrf
        <div class="mb-6">
            <label for="amount" class="inline-block text-lg mb-2">Set your budget for this month</label>
            <input type="text" id="amount" name="amount" class="border border-gray-200 rounded p-2 w-full" placeholder="Enter your budget amount">
        </div>
        <div class="mb-6">
            <label for="categories">Favorite Categories</label>
            <div>
                <input type="checkbox" id="category-electronics" name="categories[]" value="electronics">
                <label for="category-electronics">Electronics</label>
            </div>
            <div>
                <input type="checkbox" id="category-bags-accessories" name="categories[]" value="bags_accessories">
                <label for="category-bags-accessories">Bags and Accessories</label>
            </div>
            <div>
                <input type="checkbox" id="category-clothing" name="categories[]" value="clothing">
                <label for="category-clothing">Clothing Items</label>
            </div>
            <div>
                <input type="checkbox" id="category-shoes" name="categories[]" value="shoes">
                <label for="category-shoes">Shoes</label>
            </div>
            <div>
                <input type="checkbox" id="category-accessories" name="categories[]" value="accessories">
                <label for="category-accessories">Accessories</label>
            </div>
            <div>
                <input type="checkbox" id="category-household-appliances" name="categories[]" value="household_appliances">
                <label for="category-household-appliances">Household Appliances</label>
            </div>
            <div>
                <input type="checkbox" id="category-other" name="categories[]" value="other">
                <label for="category-other">Other</label>
            </div>
            <div>
                <input type="text" id="custom-categories" name="custom_categories" class="border border-gray-200 rounded p-2 w-full" placeholder="Enter custom categories (comma-separated)">
            </div>
        </div>
        <div class="mb-6">
            <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                Set Budget
            </button>
        </div>
    </form>
    </x-card>
</x-layout>
