<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notetable;
use Illuminate\Http\Request;

class NotetableController extends Controller
{
    public function get_notes(){
        $data = Notetable::orderBy('id','DESC')->get();

        return response()->json([
            'notes'=> $data
        ],200);
    }
}
