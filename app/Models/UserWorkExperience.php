<?php

namespace App\Models;

use App\Models\FunctionsInWork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserWorkExperience extends Model
{
    use HasFactory;

    //make a realtion between work experience and functionsInWork, a work experience can have many functions
    public function functions()
    {
        return $this->hasMany(FunctionsInWork::class, 'work_experience_id', 'id');
    }

    //make a relationship between work experience and PositionCompetences.
    public function competences()
    {
        return $this->hasMany(PositionCompetence::class, 'position_id', 'id');
    }
}
