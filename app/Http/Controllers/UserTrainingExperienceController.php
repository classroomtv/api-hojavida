<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTrainingExperience;
use App\Http\Resources\UserTrainingExperienceResource;

class UserTrainingExperienceController extends Controller
{


    public function get()
    {
        $user_id = auth()->user()->id;
        $trainingExperience = UserTrainingExperience::where('user_id', $user_id)->get();
        return UserTrainingExperienceResource::collection($trainingExperience);
    }

    public function getByUser(Request $request)
    {
        $user_id = $request->route('id');
        $trainingExperience = UserTrainingExperience::where('user_id', $user_id)->get();
        return UserTrainingExperienceResource::collection($trainingExperience);
    }

    public function getSpecific(Request $request)
    {
        $user_id = $request->route('user_id');
        $experience_id = $request->route('experience_id');
        $trainingExperience = UserTrainingExperience::where('user_id', $user_id)->where('id', $experience_id)->get();
        return UserTrainingExperienceResource::collection($trainingExperience);
    }
}
