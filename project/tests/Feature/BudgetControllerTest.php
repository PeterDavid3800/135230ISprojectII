<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Budget;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function authenticated_user_can_set_budget()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $budgetData = [
            'amount' => 1000,
            'categories' => ['food', 'entertainment'],
        ];

        $response = $this->post('/budget', $budgetData);

        $response->assertRedirect('/budget');

        $this->assertDatabaseHas('budgets', [
            'user_id' => $user->id,
            'amount' => $budgetData['amount'],
        ]);
    }

    /** @test */
    public function user_can_view_budget()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->get('/budget-display');

        $response->assertStatus(200);
        $response->assertViewIs('budget-display');
    }
}
