<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <div class="mt-6 p-4">
        @if (count($scrapedData) == 0)
            <p>No Scraped Data Found</p>
        @else
            @foreach($scrapedData as $data)
                <x-card>
                    <div class="flex">
                        <a href="{{ $data['productLink'] }}">
                            <img class="hidden w-48 mr-6 md:block" src="{{ $data['imageURL'] }}" alt="{{ $data['productName'] }}" />
                        </a>
                        <div>
                            <h3 class="text-2xl">
                                <a href="{{ $data['productLink'] }}">{{ $data['productName'] }}</a>
                            </h3>
                            <div class="text-xl font-bold mb-4">{{ $data['productBrand'] }}</div>
                            <strong style="color: red;">{{ $data['productDiscount'] }}</strong>
                            <strong style="color: red;">Discount</strong><br>
                            <strong> ${{ $data['productPrice'] }}</strong>
                        </div>
                    </div>
                    <div class="flex">
                        <a href="{{ $data['productLink'] }}">
                            <i class="fa-solid fa-globe"></i> Visit on its Website
                        </a>
                    </div>
                </x-card>
            @endforeach
        @endif
    </div>
</x-layout>
