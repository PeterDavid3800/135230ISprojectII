<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Listing;

class ListingControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_listing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/listings', [
            'title' => 'Test Listing',
            'company' => 'Test Company',
            'location' => 'Test Location',
            'website' => 'http://test.com',
            'oldPrice' => 10.00,
            'newPrice' => 8.00,
            'email' => 'test@example.com',
            'tags' => 'test, example',
            'description' => 'This is a test listing.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('listings', ['title' => 'Test Listing']);
    }

    /** @test */
    public function a_user_can_edit_own_listing()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put("/listings/{$listing->id}", [
            'title' => 'Updated Test Listing',
            'company' => 'Updated Test Company',
            'location' => 'Updated Test Location',
            'website' => 'http://updated-test.com',
            'oldPrice' => 12.00,
            'newPrice' => 10.00,
            'email' => 'updated-test@example.com',
            'tags' => 'updated, test',
            'description' => 'This is an updated test listing.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('listings', ['title' => 'Updated Test Listing']);
    }


    /** @test */
    public function a_user_can_add_listing_to_cart()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create();

        $this->actingAs($user)
            ->post("/listings/{$listing->id}/add-to-cart", [
                'quantity' => 2,
            ]);

        $this->assertDatabaseHas('cart_items', [
            'user_id' => $user->id,
            'listing_id' => $listing->id,
            'quantity' => 2,
        ]);
    }

    /** @test */
    public function a_user_can_remove_listing_from_cart()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create();

        $this->actingAs($user)
            ->post("/listings/{$listing->id}/add-to-cart", [
                'quantity' => 2,
            ]);

        $this->actingAs($user)
            ->delete("/listings/{$listing->id}/remove-from-cart");

        $this->assertDatabaseMissing('cart_items', [
            'user_id' => $user->id,
            'listing_id' => $listing->id,
        ]);
    }
}
