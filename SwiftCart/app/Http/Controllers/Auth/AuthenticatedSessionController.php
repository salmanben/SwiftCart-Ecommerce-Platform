<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create(): View
    {

        $targetUrl = redirect()->back()->getTargetUrl();
        // Get the route name based on the URL
        $routeName = Route::getRoutes()->match(app('request')->create($targetUrl))->getName();
        session()->put('previous_route', $routeName);
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        $request->session()->regenerate();
        if (auth()->user()->status == 'inactive') {
            Auth::guard('web')->logout();
            toastr()->error('Your account is inactivated!');
            return redirect('/');
        }
        if (auth()->user()->role == 'admin')
            return redirect()->route('admin.dashboard');
        else if (auth()->user()->role == 'vendor')
            return redirect()->route('vendor.dashboard');
        else {
            if (session()->has('previous_route') && session('previous_route') != 'home' && preg_match("/^user.*$/", session('previous_route'))) {

                return redirect()->route(session('previous_route'));
            }
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
