@props(['listing'])
<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tags :tagsCsv="$listing->tags" />
                <div class="text-lg mt-4">
                    <strong style="color: red;"> <del>Was Kshs {{$listing->oldPrice}}</del> </strong> <br>
                    <strong><span style="color: red;">
                        After 
                        <?php
                        $oldPrice = $listing->oldPrice;
                        $newPrice = $listing->newPrice;
                
                        $discountPercentage = ($oldPrice - $newPrice) / $oldPrice * 100;
                    
                        echo number_format($discountPercentage, 2) . '%';
                        ?>
                        discount
                    </span></strong><br>
                    <strong> Is now</strong><br>
                    <strong> Kshs {{$listing->newPrice}}</strong>
                </div>
                
        </div>
    </div>
</x-card>