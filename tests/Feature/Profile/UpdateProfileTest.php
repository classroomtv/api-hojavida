<?php

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        \Artisan::call('passport:install');

        $this->user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john-doe@mail.com',
        ]);

        Passport::actingAs($this->user);

        $access_token = $this->user->createToken('authToken')->accessToken;

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ]);
    }

    /** @test */
    public function authenticated_user_can_update_his_profile()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('profile.update'), [
            'name' => 'John Doe Edited',
            'email' => 'john-doe@mail.com',
            'last_name' => 'Doe edited',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe Edited',
            'email' => 'john-doe@mail.com',
            'last_name' => 'Doe edited',
        ]);


    }

    /** @test */
    public function email_is_optional_but_must_be_valid_if_present()
    {
        $this->actingAs($this->user);


        $this->postJson(route('profile.update'), [
            'name' => 'John Doe Edited',
            'last_name' => 'Doe edited'
        ])->assertOk();

        $this->postJson(route('profile.update'), [
            'name' => 'John Doe Edited',
            'email' => 'invalid-email',
            'last_name' => 'Doe edited',
        ])->assertJsonValidationErrors('email');

        $this->postJson(route('profile.update'), [
            'name' => 'John Doe Edited',
            'email' => 'john-doe@mail.com',
            'last_name' => 'Doe edited'
        ])->assertOk();

    }

    /** @test */
    public function email_must_be_unique()
    {
        $this->actingAs($this->user);

        User::factory()->create([
            'email' => 'ernesto@mail.com',
        ]);

        $this->postJson(route('profile.update'), [
            'name' => 'John Doe Edited',
            'email' => 'ernesto@mail.com',
            'last_name' => 'Doe edited',
        ])->assertJsonValidationErrors('email');
    }
}
