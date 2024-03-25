<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
        $incomingFields = $request->validate([
            'login_email'=>'required',
            'login_password' => 'required',
        ]);

        if(auth()->attempt(['email'=>$incomingFields['login_email'], 'password'=>$incomingFields['login_password']])){
            $request->session()->regenerate();
            return redirect('/')->with('success','User logged in successfully!');
        }else{
            return redirect('/')->with('error','Invalid Login');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name'=> ['required','min:3','max:10'],
            'email'=> ['required','email', Rule::unique('users','email')],
            'password'=> ['required','min:8','max:200'],
            'confirm_password'=>['required','min:8','max:200'],
        ]);

        $pw = $request->input('password');
        $confirm_pw = $request->input('confirm_password');

        $newUser = ([
            'name'=> $incomingFields['name'],
            'email'=> $incomingFields['email'],
            'password'=> $request->input('password'),
        ]);

        if($pw == $confirm_pw){
            $newUser['password'] = bcrypt($newUser['password']);
            $user = User::create($newUser);
            auth()->login($user);

            return redirect('/')->with('success','Welcome! You were registered and logged in!');
        }else{
            return redirect('/')->with('error','Registration unsuccessful, please try again.');
        }
    }
}
