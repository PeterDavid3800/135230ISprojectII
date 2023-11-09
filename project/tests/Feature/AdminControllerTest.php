<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function admin_can_view_user_creation_form()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/admin/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.create');
    }

    /** @test */
    public function admin_can_create_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'role' => 'user',
        ];

        $response = $this->post('/admin/create', $user);

        $response->assertRedirect('/admin/list');

        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }

    /** @test */
    public function admin_can_view_user_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/admin/list');

        $response->assertStatus(200);
        $response->assertViewIs('admin.list');
    }

    /** @test */
    public function admin_can_edit_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();

        $response = $this->get("/admin/edit/{$user->id}");

        $response->assertStatus(200);
        $response->assertViewIs('admin.edit');
    }

    /** @test */
    public function admin_can_update_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();

        $updatedUserData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'role' => 'merchant',
        ];

        $response = $this->put("/admin/{$user->id}", $updatedUserData);

        $response->assertRedirect('/admin/list');

        $this->assertDatabaseHas('users', ['email' => $updatedUserData['email']]);
    }

    /** @test */
    public function admin_can_delete_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();

        $response = $this->delete("/admin/{$user->id}");

        $response->assertRedirect('/admin/users');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
