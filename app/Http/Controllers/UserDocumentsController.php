<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDocuments;
use App\Http\Resources\UserDocumentsResource;

class UserDocumentsController extends Controller
{

    function get(Request $request)
    {
        $user_id = auth()->user()->id;
        $documents = UserDocuments::where('user_id', $user_id)->get();
        return UserDocumentsResource::collection($documents);
    }

    function getByUser(Request $request)
    {
        $user_id = $request->route('id');
        $documents = UserDocuments::where('user_id', $user_id)->get();
        return UserDocumentsResource::collection($documents);
    }

    function getSpecific(Request $request)
    {
        $user_id = $request->route('user_id');
        $document_id = $request->route('document_id');
        $documents = UserDocuments::where('user_id', $user_id)->where('id', $document_id)->get();
        return UserDocumentsResource::collection($documents);
    }
}
