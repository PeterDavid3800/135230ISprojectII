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

        // Redirect to the budget creation page with a success message
        return redirect()->route('wallet')->with('message', 'Budget set successfully');
    }

    public function generateCategoryChart()
    {
        // Fetch all budgets from the database
        $allBudgets = Budget::all();

        // Initialize an empty array to store aggregated categories
        $aggregatedCategories = [];

        // Loop through each budget and aggregate categories
        foreach ($allBudgets as $budget) {
            $categoriesArray = json_decode($budget->categories, true);

            foreach ($categoriesArray as $category) {
                // Increment the count for each category
                $aggregatedCategories[$category] = ($aggregatedCategories[$category] ?? 0) + 1;
            }
        }

        // Pass the aggregated data to the view
        return view('pie-chart')->with('categoriesArray', $aggregatedCategories);
    }

    public function wallet()
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Retrieve the user's budget
        $budget = $user->budget;
    
        // Pass the budget amount to the wallet view
        return view('wallet')->with('budgetAmount', optional($budget)->amount);
    }
}
