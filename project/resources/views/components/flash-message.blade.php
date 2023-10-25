@if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-0 left-0 right-0 flex justify-center items-center bg-laravel text-white">
    <div class="px-48 py-3">
        <p>
            {{session('message')}}
        </p>
    </div>
</div>
@endif
