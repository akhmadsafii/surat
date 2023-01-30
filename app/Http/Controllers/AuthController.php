<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        session()->put('title', 'Login Aplikasi');
        return view('content.auth.v_login');
    }

    public function verify_login(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($this->check_credentials($request), $request->filled('remember'))) {
            return response()->json([
                'message' =>  'Login sebagai admin berhasil',
                'status' =>  true,
                'target_url' =>  route('admin.dashboard'),
            ]);
        } else if (Auth::guard('user')->attempt($this->check_credentials($request), $request->filled('remember'))) {
            return response()->json([
                'message' =>  'Login sebagai Pengguna berhasil',
                'status' =>  true,
                'target_url' =>  route('user.dashboard'),
            ]);
        }

        return response()->json([
            'message' =>  'Anda tidak mempunyai akses untuk login',
            'status' =>  false,
            'target_url' =>  route('auth.login'),
        ]);
    }

    protected function check_credentials(Request $request)
    {
        // dd($request);
        if (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
        }
        return ['phone' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }

        return redirect()->route('auth.login');
    }
}
