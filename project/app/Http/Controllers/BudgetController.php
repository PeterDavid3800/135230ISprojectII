<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{
    public function create()
{
    return view('budget');
}

public function store(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'amount' => 'required|numeric|min:0', // Add any other validation rules as needed
        // Add validation rules for categories or tags selection if required
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Store the budget in the database
    $budget = new Budget();
    $budget->user_id = $user->id;
    $budget->amount = $request->input('amount');
    // Add code to handle category or tag selection if needed

    $budget->save();

    // Redirect to a success page or the budget settings page
    return redirect()->route('budget.create')->with('success', 'Budget set successfully');
}


}
