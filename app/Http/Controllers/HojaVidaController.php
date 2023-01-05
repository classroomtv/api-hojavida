<?php

namespace App\Http\Controllers;

use App\Http\Resources\HojaVidaResource;
use App\Models\HojaVida;
use Illuminate\Http\Request;

class HojaVidaController extends Controller
{

    public function get()
    {
        $user_id = auth()->user()->id;
        $hojas = HojaVida::where('user_id', $user_id)->get();
        return HojaVidaResource::collection($hojas);
    }

    public function getSpecific($id)
    {
        $hoja = HojaVida::find($id)->get();
        return HojaVidaResource::collection($hoja);
    }
}
