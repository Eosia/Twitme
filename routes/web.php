<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  UserController,
};

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

Route::get('security', function(){
    return 'Ok tu est autorisé à rentrer!';
})->middleware('password.confirm');

//Route::get('/', function () {
//    $user1 = User::find(1);
//    $user2 = User::find(2);
//    $user1->toggleFollow($user2->id);
//    dd($user1->isFollower($user2->id), $user2->isFollowing($user1->id));
//});

Route::get('/verified', function () {
    return 'Ton email est vérifié.';
})->middleware('auth', 'verified');

Route::middleware(['auth'])->group(function(){
    Route::get('profile/{locale?}', [UserController::class, 'profile'])->name('profile');

    Route::get('password', [UserController::class, 'password'])->name('password');

    Route::delete('destroy', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
});

























