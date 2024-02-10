<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class LoginSocialController extends Controller
{
    public function redirect_github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function login_github()
    {
        $githubUser = Socialite::driver('github')->user();
        $user = User::where('email', $githubUser->email)->first();
        if ($user && $user->status == 'inactive') {
            Auth::guard('web')->logout();
            toastr()->error('Your account is inactivated!');
            return redirect('/');
        }
        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => Hash::make(Str::random(5)),

        ]);
        $user->sendEmailVerificationNotification();

        Auth::login($user);
        if (auth()->user()->role == 'vendor')
            return redirect()->route('vendor.dashboard');
        else
            return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function redirect_google()
    {

        return Socialite::driver('google')->redirect();
    }

    public function login_google()
    {



        $user = Socialite::driver('google')->user();

        $finduser = User::where('email', $user->email)->first();

        if ($finduser) {
            if ($finduser && $finduser->status == 'inactive') {
                Auth::guard('web')->logout();
                toastr()->error('Your account is inactivated!');
                return redirect('/');
            }
            Auth::login($finduser);

            if (auth()->user()->role == 'vendor')
                return redirect()->route('vendor.dashboard');
            else
                return redirect()->intended(RouteServiceProvider::HOME);
        } else {

            $newUser = User::create([

                'name' => $user->name,
                'password' => Hash::make(Str::random(5)),

                'email' => $user->email,

            ]);
            $newUser->sendEmailVerificationNotification();

            Auth::login($newUser);

            return redirect()->back();
        }
    }
}
