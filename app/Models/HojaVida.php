<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HojaVida extends Model
{
    use HasFactory;
    protected $table = 'hoja_vida';

    public function views()
    {
        return $this->hasMany(LogVisit::class, 'id_hoja', 'id');
    }
}
