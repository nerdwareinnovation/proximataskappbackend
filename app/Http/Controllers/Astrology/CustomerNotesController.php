<?php

namespace App\Http\Astrokogy\Controllers;

use Illuminate\Http\Request;
use App\Models\Astrology\CustomerNotes;
Use Auth;
class CustomerNotesController extends Controller
{
     public function storeNote(Request $request){
            $validated = $request->validate([
                'note' => 'required',
                'customer_id' => 'required',
            ]);
            $customerNote = new CustomerNotes();
            $customerNote->note =  $request['note'];
            $customerNote->customer_id =  $request['customer_id'];
            $customerNote->user_id =  Auth::user()->id;
            $customerNote->save();
            return response()->json(['success'=>'Customer note added!']);

        }
    public function updateNote(Request $request){
        $validated = $request->validate([
            'note' => 'required',
            'id' => 'required',
        ]);
        $customerNote =  CustomerNotes::find($request['id']);
        $customerNote->note =  $request['note'];
        $customerNote->save();
        return redirect()->back()->with(['Success'=>'Customer Note Updated']);

    }
    public function deleteNote(Request $request,$id){
        $customerNote =  CustomerNotes::find($id)->delete();
        return redirect()->back()->with(['Success'=>'Customer Note Deleted']);

    }
}
