<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Storage;

class UserController extends Controller
{
    //
    public function __construct() {
        $this->middleware('verified');
    }

    public function profile() {
        $data = [
            'title' => "Mon profil",
            'user' => Auth::user(),
        ];
        return view('user.profile', $data);
    }
    public function password()
    {
        return view('user.password')->with('title', 'Changer le mot de passe');
    }

}
