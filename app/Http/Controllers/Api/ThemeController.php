<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Themes;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    //
    public function index()
    {
        $theme = Themes::get();
        return response()->json([
            'data'=>$theme,
            'status'=> 200
        ]);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([

            'theme' => 'required',
            'theme_name' => 'required',

        ]);

        $themes = $request->file('theme');

        $path = public_path('themes');
//        dd($attachments);
        if ($themes != NULL) {
            $themes->move($path, $themes->getClientOriginalName());
        }
        $theme = new Themes();
        if ($themes != NULL){
            $theme['theme'] = $themes->getClientOriginalName();
        }
        $theme['theme_name']=$request->theme_name;
        $theme['user_id']= auth()->user()->id;
        $theme->save();
        return response()->json([
            'data'=> $theme,
            'message'=>"Theme Created successfully",
            'status'=>200,
        ]);

    }

    public function delete($id)
    {
     $theme = Themes::find($id);
     $theme->delete();
        return response()->json([
            'data'=> $theme,
            'message'=>"Theme Deleted successfully",
            'status'=>200,
        ]);
    }
}
