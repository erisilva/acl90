<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Auth;

class ChangeThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['middleware' => 'auth']);
        $this->middleware(['middleware' => 'hasaccess']);
    }

    public function showThemeUpdateForm(){

        $themes = Theme::orderBy('description', 'asc')->get();

        return view('admin.users.theme', compact('themes'));
    }

    public function themeUpdate(Request $request){
        $input = $request->all();
        $user = Auth::user();

        $user->theme_id = $input['theme_id'];
        $user->update();

        Session::flash('theme_altered', 'Tema alterado!');

        $themes = Theme::orderBy('description', 'asc')->get();

        return view('admin.users.theme', compact('themes'));
    }    
}
