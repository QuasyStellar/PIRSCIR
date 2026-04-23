<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller {
    public function index() {
        return view('settings');
    }

    public function store(Request $request) {
        session([
            'theme' => $request->theme,
            'language' => $request->language,
            'user_login' => $request->login
        ]);
        session()->save();
        return redirect('/');
    }
}
