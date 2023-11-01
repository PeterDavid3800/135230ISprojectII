<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
      <header class="text-center">
          <h2 class="text-2xl font-bold uppercase mb-1">Create a Discount</h2>
          <p class="mb-4">Post a discount for customers</p>
      </header>

      <form method="POST" action="/listings" enctype="multipart/form-data">
          @csrf
          <div class="mb-6">
              <label for="company" class="inline-block text-lg mb-2">Company Name</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" value="{{ old('company') }}" />

              @error('company')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="title" class="inline-block text-lg mb-2">Product Title</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" placeholder="Example: Lenovo Laptop" value="{{ old('title') }}" />

              @error('title')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="location" class="inline-block text-lg mb-2">Company Location</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location" placeholder="Example: Westlands, Nairobi etc" value="{{ old('location') }}" />

              @error('location')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ old('email') }}" />

              @error('email')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
            <label for="website" class="inline-block text-lg mb-2">
              Website/Application URL
            </label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
              value="{{old('website')}}" />
    
            @error('website')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div>
          

          <div class="mb-6">
              <label for="oldPrice" class="inline-block text-lg mb-2">Former Price</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="oldPrice" placeholder="Price before Discount, avoid commas" value="{{ old('oldPrice') }}" />

              @error('oldPrice')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="newPrice" class="inline-block text-lg mb-2">New Price</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="newPrice" placeholder="Price after Discount, avoid commas" value="{{ old('newPrice') }}" />

              @error('newPrice')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="tags" class="inline-block text-lg mb-2">Tags (Comma Separated)</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: Electronics, Food and Beverage, Clothing etc" value="{{ old('tags') }}" />

              @error('tags')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="logo" class="inline-block text-lg mb-2">Company Logo</label>
              <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

              @error('logo')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="description" class="inline-block text-lg mb-2">Product Description</label>
              <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Include discount percentage, specs if it is a machine, and so on">{{ old('description') }}</textarea>

              @error('description')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Post Discount</button>

              <a href="/" class="text-black ml-4">Back</a>
          </div>
      </form>
  </x-card>
</x-layout>
