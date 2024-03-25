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
    $allposts = Post::all()->sortDesc();
    return view('home',['posts'=> $posts, 'allposts'=> $allposts]);
})->name('user.home');

Route::controller(UserController::class)->group(function(){
    Route::post('/register', 'register')->name('user.register');
    Route::post('/login', 'login')->name('user.login');
    Route::post('/logout', 'logout')->name('user.logout');
});

Route::controller(PostController::class)->group(function(){
    Route::post('/create_post', 'create_post')->name('post.create_post');
    Route::get('/edit_post/{post}', 'showEditScreen')->name('post.show_edit_screen');
    Route::put('/edit_post/{post}', 'editPost')->name('post.edit');
    Route::delete('/delete_post/{post}', 'deletePost')->name('post.delete'); 
});
