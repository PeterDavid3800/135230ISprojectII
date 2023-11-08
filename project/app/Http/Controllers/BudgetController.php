<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        'amount' => 'required|numeric|min:0',
        'categories' => 'array', // Ensure 'categories' is an array
        'custom_categories' => 'nullable|string', // Custom categories are optional
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Serialize the categories array to JSON
    $categories = json_encode($request->input('categories'));

    // Create a new Budget instance
    $budget = new Budget();
    $budget->user_id = $user->id;
    $budget->amount = $request->input('amount');
    $budget->categories = $categories;

    // Save the budget to the database
    $budget->save();

    $categoriesArray = json_decode($budget->categories, true);

    // Redirect to a success page or the budget settings page
    return view('/budget')->with('message', 'Budget set successfully');
}

public function displayBudget()
{
    $user = Auth::user();
    $userHasBudget = $user->budget !== null;
    $userBudgetAmount = $userHasBudget ? $user->budget->amount : null;

    return view('budget-display', compact('userHasBudget', 'userBudgetAmount'));
}

}
