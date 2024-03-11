<?php

namespace App\Http\Controllers\Astrology\Admin;

use App\Models\Astrology\FilterWords;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterWordsController extends Controller
{
    public function index(){
        $filterWords = FilterWords::all();
        return view('astro.admin.parasiticWords')->with(compact('filterWords'));
    }
    public function storeParasiticWord(Request $request){
        $validated = $request->validate([
            'parasitic_word' => 'required',
        ]);
        $filter_words = new FilterWords();
        $filter_words->word = $request['parasitic_word'];
        $filter_words->save();
        $notification=array(
            'messege'=>'New Word Added !',
            'alert-type'=>'success'
        );
        return redirect(route('admin.parasiteWords'))->with($notification);
    }
    public function deleteParasiteWords($id){
        $parasite_word = FilterWords::find($id);
        if ($parasite_word){
            $parasite_word->delete();
        }
        $notification=array(
            'messege'=>'Word Has been Deleted Successfully!',
            'alert-type'=>'success'
        );
        return redirect(route('admin.parasiteWords'))->with($notification);
    }
}
