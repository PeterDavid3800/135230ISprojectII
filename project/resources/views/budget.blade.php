<x-layout>
@section('content')
<div class="container">
    <h1>Set Your Budget</h1>
    <form method="POST" action="{{ route('budget.store') }}">
        @csrf
        <div class="form-group">
            <label for="amount">Budget Amount</label>
            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter your budget amount">
        </div>
        <!-- Add category/tag selection fields here -->
        <button type="submit" class="btn btn-primary">Set Budget</button>
    </form>
</div>
</x-layout>
