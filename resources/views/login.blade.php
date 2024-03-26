@extends('layout')
@section('title','Login')
@section('body-content')
    <div class="container">
        <legend>Login to Larablog</legend>
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
        <form action="{{route('user.login')}}" method="post">
            @csrf
            <div class="mb-3">
              <label for="login_email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="login_email" name="login_email" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="login_password" class="form-label">Password</label>
              <input type="password" class="form-control" id="login_password" name="login_password">
            </div>
            <div class="mb-3"><a href="">Forgot Password</a></div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button id="HomeButton" type="button" class="btn btn-secondary">Go Back</button>
          </form>
    </div>
    @section('scripts')
    <script type="text/javascript">
        document.getElementById("HomeButton").onclick = function () {
            location.href = "{{route('user.home')}}";
        };
    </script>
    @endsection
@endsection