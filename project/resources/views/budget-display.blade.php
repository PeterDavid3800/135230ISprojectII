<x-layout>
    <div class="mt-8">
        @if ($userHasBudget)
            <h1>Your Budget Amount: ${{ $userBudgetAmount }}</h1>
        @else
            <p>You haven't set your budget yet. <a href="{{ route('budget.create') }}">Set Your Budget</a></p>
        @endif
    </div>
</x-layout>
