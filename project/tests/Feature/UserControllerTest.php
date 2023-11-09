<?php 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_register()
    {

        $user = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'role' => 'user',
        ];

        $response = $this->post('/users', $user);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', ['email' => $user['email']]);

        $this->assertAuthenticated();

    }

    /** @test */
    public function a_user_can_login()
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $response = $this->post('/users/authenticate', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        
        $this->assertAuthenticatedAs($user);

    }

    public function a_user_can_resend_otp_for_registration()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/resend-registration-otp');

        $response->assertRedirect('/verify-registration-otp');

        $response->assertSessionHas('message', 'A new OTP has been sent to your email.');

    }

    /** @test */
    public function a_user_can_resend_otp_for_login()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/resend-otp');

        $response->assertRedirect('/verify-login-otp');

        $response->assertSessionHas('message', 'A new OTP has been sent to your email.');
    }
}
