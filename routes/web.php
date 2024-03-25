<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
    //$posts = Post::where('user_id', auth()->id())->get(); //Did not use model relations(pointless)
    $posts = [];
    if (auth()->check()){
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    return view('home',['posts'=> $posts]);
})->name('user.home');

Route::post('/register', [UserController::class,'register'])->name('user.register');
Route::post('/login', [UserController::class,'login'])->name('user.login');
Route::post('/logout', [UserController::class,'logout'])->name('user.logout');

Route::post('/create_post', [PostController::class,'create_post'])->name('post.create_post');