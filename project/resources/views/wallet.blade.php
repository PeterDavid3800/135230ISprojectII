<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Your Wallet</h2>
        </header>
        <div>
            @if(isset($budgetAmount))
            <div style="text-align: center;">
                <strong style="color: green; font-size: 24px;">Your Current Budget</strong><br>
                <strong style="color: green; font-size: 36px;">Kes {{ $budgetAmount }}</strong>
            </div>
            @else
                <p>No budget set yet.</p>
            @endif
        </div>
    </x-card>
</x-layout>
