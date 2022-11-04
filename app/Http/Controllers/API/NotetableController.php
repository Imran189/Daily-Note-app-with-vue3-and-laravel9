<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notetable;
use App\Models\User;
use Illuminate\Http\Request;

class NotetableController extends Controller
{
    public function get_notes($id){
        $data = Notetable::where('user_id',$id)->orderBy('status','DESC')->get();

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

    public function save_note(Request $request, $id){
        $data= new Notetable();
        $data->user_id =$id;
        $data->date = now();
        $data->note =$request->note;
        $data->status =$request->status;
        $data->save();

    }

    public function update_status(Request $request,$id){
        $data = Notetable::findOrFail($id);

        $data->status = $request->status;
        $data->save();
        return response()->json($request->status,200);
    }

    public function delete_note($id){
        $data = Notetable::findOrFail($id);
        $data->delete();
        return response()->json(200);
    }

    public function get_edit_note($id){
        $data = Notetable::find($id);
         return response()->json([
            'note'=>$data
         ],200);
    }

    public function update_note(Request $request,$id){
        $data= Notetable::find($id);
        $data->note=$request->note;
        $data->date=$request->date;

        $data->save();
    }
}
