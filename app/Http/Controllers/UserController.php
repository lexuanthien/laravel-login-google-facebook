<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('/user/login');
    }

    public function postLogin(Request $request) {
        $remember = false;
        if(isset($request->remember_me)) {
            $remember = true;
        }
        if(User::where('email', $request->email)->exists()){
            $user = User::whereNull('deleted_at')->where('email', $request->email)->first();
            if($user->exists()){
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                    Auth::login($user);
                    return redirect()->route('home');
                } else {
                    return redirect()->route('login')->withErrors(['message' => "Email or password is incorrect"]);
                }
            } else {
                return redirect()->route('login')->withErrors(['message' => "User not found"])->withInput();
            }
        } else {
            return redirect()->route('login')->withErrors(['message' => "Do not leave it blank"]);
        }
    }

    public function redirectToProvider(Request $request) {
        return Socialite::driver($request->provider)->stateless()->redirect();
    }
   
    public function handleProviderCallback(Request $request) {
        try {
            $user = Socialite::driver($request->provider)->stateless()->user();
            if(empty($user->email)) {
                return redirect()->route('login')->withErrors(['message' => "Error! An error occurred when login with provider {$request->provider}. Please try again later."]);
            }
            $findUser = User::where('provider_id', $user->id)->first();
            if($findUser){
                $findUser->update([
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'provider' => $request->provider,
                    'access_token' => $user->token
                ]);
                Auth::login($findUser);
                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'provider' => $request->provider,
                    'provider_id'=> $user->id,
                    'access_token' => $user->token
                ]);
                Auth::login($newUser);
                return redirect()->route('home');
                // return redirect()->back();
            }
        } catch (Exception $e) {
            return redirect()->route('login.provider');
        }
        //Khi muốn gọi một function khác trong Controller -> Sử dụng:
        // return $this->redirectToProvider($user, $request->provider);
    }

    public function register() {
        if (Auth::check()) {
            return view('home');
        }
        return view('/user/register');
    }

    public function postRegister(Request $request) {
        //validate
        $validator = Validator::make($request->all(), [
            'name' => 'max:50',
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return ["errors" => $validator->errors()];
        }
        else {
            $user = User::where('provider', 'client')->whereNull('deleted_at')->where('email', $request->email)->first();
            if($user){
                return back()->withErrors(['message' => "Mail address already exists"]);
            } else {
                $newUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'provider' => 'client',
                    'password' => bcrypt($request->password),
                ]);
                return redirect()->route('login');
            }
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }
}
