<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        if ($request->isMethod('POST')) {
            $user = User::where('type', Constants::ADMIN)
                ->where('email', $request->get('email'))
                ->where('email_verified_at', '!=', null)
                ->first();
            if (! $user || ! Hash::check($request->get('password'), $user->password)) {
                return Redirect::back()->with(['error' => 'Unauthorised']);
            } else {
                Auth::login($user);
                $token = $user->createToken('MyApp')->plainTextToken;
                Session::put('auth_token', $token);

                return Redirect::route('admin.dashboard');
            }

        } else {
            return view('cpanel.auth.login');
        }
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return \redirect()->route('admin.login');
    }
}
