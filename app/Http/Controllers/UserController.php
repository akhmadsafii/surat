<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Daftar Pengguna');
        $user = [];
        foreach (Helper::job_array() as $key => $value) {
            $list_user = User::where([
                ['position', $key],
                ['status', '!=', 0],
            ])->first();
            $user[] = [
                'code' => $key,
                'position' => $value,
                'name' => $list_user != null ? $list_user['name'] : null,
                'nip' => $list_user != null ? $list_user['nip'] : null,
                'file' => $list_user != null && $list_user['file'] != null ? asset($list_user['file']) : asset('asset/img/user4.jpg'),
            ];

            // dd($list_user);
        }
        // dd($user);
        return view('content.users.v_user', compact('user'));
    }
}
