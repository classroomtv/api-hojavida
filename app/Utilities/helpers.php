<?php

namespace App\Utilities;

class helpers
{
    public static function cifrar($mensaje, $clave) {
        $mensaje = strtolower($mensaje);
        $clave = strtolower($clave);
        $alfabeto = '2167895340-fwjkylzgmnxqrtvcbpdsouieña:"{}';
        $mensaje_cifrado = '';
        for ($i = 0; $i < strlen($mensaje); $i++) {
            $letra = $mensaje[$i];
            if (strpos($alfabeto, $letra) !== false) {
                $indice = strpos($alfabeto, $letra);
                $nuevo_indice = ($indice + $clave) % strlen($alfabeto);
                $mensaje_cifrado .= $alfabeto[$nuevo_indice];
            } else {
                $mensaje_cifrado .= $letra;
            }
        }
        $cadena = base64_encode($mensaje_cifrado);

        $nueva_cadena = "";
        for ($i = 0; $i < strlen($cadena); $i++) {
            $nueva_cadena .= ord($cadena[$i]) . " ";
        }

        return base64_encode($nueva_cadena);
    }

    public static function descifrar($mensaje_cifrado, $clave) {

        $cadena = trim(base64_decode($mensaje_cifrado));
        $valores = explode(" ", $cadena);
        $nueva_cadena = "";
        foreach ($valores as $valor) {

            $nueva_cadena .= chr($valor);

        }
        $mensaje_cifrado = strtolower(base64_decode($nueva_cadena));
        $clave = strtolower($clave);
        $alfabeto = '2167895340-fwjkylzgmnxqrtvcbpdsouieña:"{}';
        $mensaje = '';
        for ($i = 0; $i < strlen($mensaje_cifrado); $i++) {
            $letra = $mensaje_cifrado[$i];
            if (strpos($alfabeto, $letra) !== false) {
                $indice = strpos($alfabeto, $letra);
                $nuevo_indice = ($indice - $clave + strlen($alfabeto)) % strlen($alfabeto);
                $mensaje .= $alfabeto[$nuevo_indice];
            } else {
                $mensaje .= $letra;
            }
        }
        return $mensaje;
    }
}

