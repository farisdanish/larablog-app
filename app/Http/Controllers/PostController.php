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
}
