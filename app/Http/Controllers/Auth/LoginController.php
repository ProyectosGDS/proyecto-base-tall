<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function authenticate(Request $request): RedirectResponse {


        $request->validate([
            'cui' => 'required|numeric|digits:13',
            'password' => 'required|string|max:15',
        ]);

        $user = User::where('cui',$request->cui)
            ->whereNull('deleted_at')
            ->first();
            
        if($user) {

            if (Hash::check($request->password, $user->password)) {
    
                $request->session()->regenerate();
        
                Auth::login($user, $request->boolean('remember'));
        
                return redirect()->intended('/');
            }                
        }

        return back()->withErrors([
            'cui' => trans('auth.failed'),
        ])->onlyInput('cui');

    }

    public function logout(Request $request): RedirectResponse {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
