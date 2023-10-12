<x-layout>
@include('partials._hero')
@include('partials._search')

@if(count($listings) == 0)
    <p>No Listings Found</p>
@else
    @foreach($listings as $listing)
     <x-listing-card :listing="$listing" />
    @endforeach
@endunless

</div>

<div class="mt-6 p-4">
    {{$listings->links()}}
</div>
</x-layout>