<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_change_password()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Manually authenticate the user
        $this->actingAs($user, 'api');

        // Simulate the change password request
        $response = $this->postJson('/api/change-password', [
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        // Assert the response
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Password Changed Successfully',
                 ]);
    }
}
