@extends('layout')
@section('title','Registration')
@section('body-content')
    <div class="container">
        <legend>Register your account</legend>
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
            @if($errors->any()) {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!} @endif
        </div>
        <form action="{{route('user.register')}}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
              </div>
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