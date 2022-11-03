<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notetable;
use App\Models\User;
use Illuminate\Http\Request;

class NotetableController extends Controller
{
    public function get_notes($id){
        $data = Notetable::where('user_id',$id)->orderBy('id','DESC')->get();

        return response()->json([
            'notes'=> $data
        ],200);
    }

    public function get_user_name($id){
        $data = User::find($id);
        return response()->json([
            'user'=>$data
        ],200);
    }
}
