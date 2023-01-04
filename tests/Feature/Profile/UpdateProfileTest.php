<?php

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
        /** @test */
        public function authenticated_user_can_update_his_profile()
    {
        \Artisan::call('passport:install');
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john-doe@mail.com',
        ])->dump();
        Passport::actingAs($user);
        $access_token = $user->createToken('authToken')->accessToken;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $access_token,

        ])->put(route('profile.update'), [
            'name' => 'John Doe Edited',
            'email' => 'john-doedited@mail.com',
            'last_name' => 'Doedited',
        ])->dump();


        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Profile updated successfully.'
            ]);

    }
}
