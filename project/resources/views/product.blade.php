<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <div class="mt-6 p-4">
        @if (!empty($product))
            <x-card>
                <div class="flex">
                    <img class="hidden w-48 mr-6 md:block" src="{{ $product['imageURL'] }}" alt="{{ $product['productName'] }}" />
                    <div>
                        <h3 class="text-2xl">
                            <a href="{{ $product['productLink'] }}">{{ $product['productName'] }}</a>
                        </h3>
                        <div class="text-xl font-bold mb-4">{{ $product['productBrand'] }}</div>
                        <strong style="color: red;">{{ $product['productDiscount'] }}</strong>
                        <strong style="color: red;">Discount</strong><br>
                        <strong> ${{ $product['productPrice'] }}</strong>
                    </div>
                </div>
            </x-card>
        @else
            <p>No Product Found</p>
        @endif
    </div>
</x-layout>