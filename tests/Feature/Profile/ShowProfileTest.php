<?php

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_get_his_profile_info()
    {
        \Artisan::call('passport:install');
        $user = User::factory()->create();
        Passport::actingAs($user);
        $access_token = $user->createToken('authToken')->accessToken;
        $response = $this->withHeaders([
           'Authorization' => 'Bearer ' . $access_token,

        ])->getJson(route('profile.info'));

        $this->assertAuthenticated();

        $response->assertJson([
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ])->dump();
        $response->assertStatus(200);

    }
}
