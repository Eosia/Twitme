<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB, Storage, App;

class UserController extends Controller
{
    //
    public function __construct() {
        $this->middleware('verified');
    }

    public function profile(?string $locale = null) {

        //App::setLocale('en');
        //dd(App::currentLocale());

         if($locale && in_array($locale, ['fr', 'en'])){
             App::setLocale($locale);
         }


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

    public function destroy()
    {
        DB::transaction(function() {
            $user = Auth::user();
            $user->delete();
            Storage::deleteDirectory('avatars/'.$user->id);
        });

        $success = 'Compte supprimé.';
        return redirect('register')->withSuccess($success);


    }


}
