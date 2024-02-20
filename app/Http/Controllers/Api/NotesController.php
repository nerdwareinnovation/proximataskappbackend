<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Lcobucci\JWT\Validation\Validator;
use Psy\Util\Json;

class NotesController extends Controller
{
    //
    public function index(){
        $notes = Notes::all();
        return response()->json($notes,200);
    }
    public function store(Request $request){
        $input = $request->all();
         $request->validate([
                'font' => 'required',
                'theme' => 'required',
                'color_option' => 'required',
                'note' => 'required',
             'note_title'=>'required'
            ]);

        $themes = $request->file('theme');

        $path = public_path('themes');
//        dd($attachments);
        if ($themes != NULL) {
            $themes->move($path, $themes->getClientOriginalName());
        }

        $notes = new Notes();
        $notes['font']= $request->font;
        if ($themes != NULL){
            $notes['theme'] = $themes->getClientOriginalName();
        }
        $notes['note']= $request->note;
        $notes['user_id'] = auth()->user()->id;
        $notes['note_title']= $request->note_title;
        $notes['color_option']= $request->color_option;
        $notes->save();

        return response()->json([
            'data'=> $notes,
            'message'=>"Notes Created successfully",
            'status'=>200,
        ]);
    }
    public function show($id){
        $notes = Notes::find($id);
        if (is_null($notes)){
            return response()->json([
               'message'=>'Notes does not exist'
            ]);
        }
        return response()->json([
            'data'=>$notes,
            'status'=>200,
            'message'=>'Notes retrived successfully'
        ]);
    }
    public function update(Request $request, $id){
        $input = $request->all();
         $request->validate([
            'font' => 'required',
            'theme' => 'required',
            'color_option' => 'required',
            'note' => 'required',
             'note_title'=>'required'
        ]);

//        dd($notes);
//        $record = Notes::find($id);
//        $record->update([
//            'font' => $request->input('font'),
//            'theme' => $request->input('theme'),
//            'color_option' => $request->input('color_option'),
//            'note' => $request->input('note'),
//]);
//        dd($request->post());
        $notes= Notes::find($id);
        $notes->font = $input['font'];
        $notes->theme = $input['theme'];
        $notes->note = $input['note'];
        $notes->note_title = $input['note_title'];
        $notes->color_option = $input['color_option'];
        $notes->save();
        return response()->json([
            'data'=> $notes,
            'message'=>"Notes updated successfully",
            'status'=>200,
        ]);
    }
    public function destroy($id ){
        $notes = Notes::find($id);
        $notes->delete();
        return response()->json([
            'message'=>"Notes deleted successfully",
            'status'=>200,
        ]);
    }

}
