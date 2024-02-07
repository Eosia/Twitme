<?php

use Illuminate\Support\Facades\Route;

use App\Models\{
  User,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', function () {
//    $user1 = User::find(1);
//    $user2 = User::find(2);
//    $user1->toggleFollow($user2->id);
//    dd($user1->isFollower($user2->id), $user2->isFollowing($user1->id));
//});


























