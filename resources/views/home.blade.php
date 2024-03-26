@extends('layout')
@section('title')
    @auth
    Home - {{ Auth::user()->name }}
    @else
    Login/Registration
    @endauth
@endsection
@section('body-content')
    @auth
    <!--If user is logged in, it will display this-->
    <h1>You are logged in</h1>
    <div>
        @If(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @elseif(session()->has('error'))
            <div>
                {{session('error')}}
            </div>
        @endif
    </div>
    <form action="{{route('user.logout')}}" method="post">
        @csrf
        <button>Logout</button>
    </form>
    <br/>

    <div style="border: 3px solid black">
        <h2>Create new post</h2>
        <form action="/create_post" method="post">
            @csrf
            <label>Enter Post Title:</label>
            <input type="text" name="title" placeholder="Post Title">
            <label>Enter Post Content:</label>
            <textarea name="content" placeholder="Post Content"></textarea>
            <button type="submit">Save Post</button>
            <br/>
        </form>
    </div>
    <br/>
    <div style="border: 3px solid black">
        <h2>Your Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}}</h3>
            {{$post['content']}}
            <p><a href="/edit_post/{{$post->id}}">Edit</a></p>
            <form action="/delete_post/{{$post->id}}" method="post">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>
    @else
    <!--Else, it will display this-->
    <button id="RegisterButton" class="float-left submit-button" >Register</button>
    <button id="LoginButton" class="float-left submit-button" >Login</button>
    <!--<div style="border: 3px solid black">
        <h2>Register</h2>
        <div>
            @If(session()->has('success'))
                <div>
                    {{session('success')}}
                </div>
            @elseif(session()->has('error'))
                <div>
                    {{session('error')}}
                </div>
            @endif
        </div>
        <form action="{{route('user.register')}}" method="post">
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="confirm_password" placeholder="confirm password">
            <button type="submit">Register</button>
        </form>
        </br>
    </div>-->
    <!--<div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="{{route('user.login')}}" method="post">
            @csrf
            <input type="text" name="login_email" placeholder="email">
            <input type="password" name="login_password" placeholder="password">
            <button type="submit">Login</button>
        </form>
        <br/>
    </div>-->
    <br/>
    <div class="container">
        <h2>All Posts</h2>
        @foreach($allposts as $apost)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$apost['title']}}</h3>
            {{$apost['content']}}
        </div>
        @endforeach
    </div>
    @endauth
    @section('scripts')
    <script type="text/javascript">
        document.getElementById("LoginButton").onclick = function () {
            location.href = "{{route('user.login_page')}}";
        };
        document.getElementById("RegisterButton").onclick = function () {
            location.href = "{{route('user.register_page')}}";
        };
    </script>
    @endsection
@endsection
