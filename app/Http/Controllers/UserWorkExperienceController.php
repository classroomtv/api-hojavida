<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserWorkExperienceResource;
use Illuminate\Http\Request;
use App\Models\UserWorkExperience;

class UserWorkExperienceController extends Controller
{

    public function get()
    {
        $user_id = auth()->user()->id;
        $workExperience = UserWorkExperience::where('user_id', $user_id)
            ->with('functions')
            ->with('competences')
            ->orderBy('position_start', 'desc')
            ->get();
        return UserWorkExperienceResource::collection($workExperience);
    }

    public function getByUser(Request $request)
    {
        $user_id = $request->route('id');
        $workExperience = UserWorkExperience::where('user_id', $user_id)->get();
        return UserWorkExperienceResource::collection($workExperience);
    }


    public function getSpecific(Request $request)
    {
        $user_id = $request->route('user_id');
        $experience_id = $request->route('experience_id');
        $workExperience = UserWorkExperience::where('user_id', $user_id)->where('id', $experience_id)->get();
        return UserWorkExperienceResource::collection($workExperience);
    }
}
