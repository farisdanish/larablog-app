<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create_post(Request $request){
        $incomingFields = $request->validate([
            "title"=> "required",
            "content" => "required",
        ]);

        $incomingFields["title"] = strip_tags($incomingFields["title"]);
        $incomingFields["content"] = strip_tags($incomingFields["content"]);
        $incomingFields["user_id"] = auth()->id();

        Post::create($incomingFields);
        return redirect()->route("user.home")->with("success","Post added successfuly");
    }

    public function showEditScreen(Post $post){
        return view('edit_post', ['post'=> $post]);
    }

    public function editPost(Post $post, Request $request){
        if (auth()->user()->id !== $post['user_id']){
            return redirect()->route('/')->with('error','User ID Mismatch.');
        }

        $incomingFields = $request->validate([
            'title'=> 'required',
            'content'=> 'required',
        ]);
        
        $incomingFields["title"] = strip_tags($incomingFields["title"]);
        $incomingFields["content"] = strip_tags($incomingFields["content"]);

        $post->update($incomingFields);
        return redirect('/')->with('success','Your post was edited successfully!');
    }

    public function deletePost(Post $post){
        if (auth()->user()->id === $post['user_id']){
            $post->delete();
            return redirect('/')->with('success','Post Deleted Successfully');
        }else{
            return redirect('/')->with('error','User ID Mismatch.');
        }
    }
}