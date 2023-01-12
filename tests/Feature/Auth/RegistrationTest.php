<?php

namespace Tests\Feature\Auth;

use App\Utilities\helpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    private $cifrado;
    private $clave;
    private $datos;

    public function setUp(): void
    {
        parent::setUp();
        $this->clave = date('Ymd');
        $this->datos = [
            'avatar_url' => 'uploads/institutions/865/users/96438/avatar/_96438_1642724026.png',
            'institution_id' => '880',
            'rut' => '17409789-k',
            'user_id' => '96438'
        ];
        $this->cifrado = Helpers::cifrar(json_encode($this->datos), $this->clave);
        //dump($this->cifrado);
    }

    /** @test */
    public function new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'hash' => $this->cifrado,
        ]);


        $response->assertOk();
        $response->assertJson([
            'message' => 'User created successfully',
            "user" => [
                "name"=> "Test User",
                "email"=> "test@example.com",
                "last_name"=> null,
                "dni"=> "17409789-k",
                "avatar"=> "uploads/institutions/865/users/96438/avatar/_96438_1642724026.png",
                "updated_at"=> "11-01-2023",
                "created_at"=> "11-01-2023",
                "id"=> 7
            ],
            "lms_register" => [
                "user_id" => 7,
                "lms_id" => 96438,
                "institution_id" => 880,
                "updated_at" => "11-01-2023",
                "created_at" => "11-01-2023",
                "id" => 1
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->assertDatabaseHas('users_in_lms', [
            'user_id' => 7,
            'lms_id' => 96438,
            'institution_id' => 880,
        ]);
    }
}
