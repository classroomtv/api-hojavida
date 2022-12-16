<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInLms extends Model
{
    use HasFactory;

    protected $table = 'users_in_lms';

    protected $fillable = [
        'user_id',
        'lms_id',
        'status',
        'institution_id',
    ];
}
