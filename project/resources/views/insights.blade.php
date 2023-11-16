<x-layout>
    <x-card>
    <h1>View Insights</h1>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh;">
        <button style="width: 200px; height: 100px; background-color: black; color: white; margin-bottom: 20px;" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            <a href="/chart" style="color: white; text-decoration: none; display: block; height: 100%; width: 100%;">
                Most purchased Order Categories
            </a>
        </button>
        <button style="width: 200px; height: 100px; background-color: black; color: white; margin-bottom: 20px;" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            <a href="/pie-chart" style="color: white; text-decoration: none; display: block; height: 100%; width: 100%;">
                Customers Best Deals
            </a>
        </button>
        <button style="width: 200px; height: 100px; background-color: black; color: white;" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            User Categories
        </button>
    </div>
    </x-card>
</x-layout>
