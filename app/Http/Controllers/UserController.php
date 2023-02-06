<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        }
        return view('content.users.v_user', compact('user'));
    }

    public function detail(Request $request)
    {
        $user = User::where([
            ['position', $request['code']],
            ['status', '!=', 0],
        ])->first();
        $user['avatar'] = $user['file'] != null ? asset($user['file']) : 'https://via.placeholder.com/150';
        // dd($user);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $customAttributes = [
            'name' => 'Nama User',
            'phone' => 'Telepon User',
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"]
        ];

        $messages = [
            'email' => ':attribute tidak valid.',
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . env('CONFIG_MAX_UPLOAD') / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $data = $request->toArray();
            if (!empty($request->file)) {
                $data = ImageHelper::upload_asset($request, 'file', 'profile', $data);
            }
            User::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'User berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }
}
