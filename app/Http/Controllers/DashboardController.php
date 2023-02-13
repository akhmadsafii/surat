<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        if (Auth::guard('admin')->check()) {
            session()->put('position', 'admin');
            session()->put('id', Auth::guard('admin')->user()->id);
        }
        if (Auth::guard('user')->check()) {
            session()->put('position', Auth::guard('user')->user()->position);
            session()->put('id', Auth::guard('user')->user()->id);
        }
        // dd(session()->all());
        return view('content.dashboard.v_admin');
    }
}
