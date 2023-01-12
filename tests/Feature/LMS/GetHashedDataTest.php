<?php

namespace Tests\Feature\LMS;

use App\Utilities\helpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use TypeError;

class GetHashedDataTest extends TestCase
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
    public function decifrar_with_invalid_value()
    {
        $mensaje_cifrado = 'some_string';
        $clave = 'some_key';

        $this->expectException(TypeError::class);

        $response = Helpers::descifrar($mensaje_cifrado, $clave);
        // TODO: generar mas tests para el metodo de cifrado/decifrado
        $response->assertValidationError('hash', 'El hash no es válido');
    }
}
