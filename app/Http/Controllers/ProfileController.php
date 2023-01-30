<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function admin()
    {
        // Auth::guard('admin')->user()->name;
        // return view('content.profiles.admin.v_main');
        if ($_GET['information'] == 'detail') {
            return view('content.profiles.admin.v_information');
        } else if ($_GET['information'] == 'edit') {
            return view('content.profiles.admin.v_edit');
        } else if ($_GET['information'] == 'reset-password') {
            return view('content.profiles.admin.v_reset_password');
        } else {
            return view('content.profiles.admin.v_close_account');
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama',
            'email' => 'Email',
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'email' => ['required'],
        ];

        $messages = [
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
            Admin::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            return response()->json([
                'message' => 'Admin berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function update_password(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'current_password' => 'Password Baru',
            'confirm_password' => 'Password Konfirmasi',
        ];
        $rules = [
            'password' => ['required'],
            'current_password' => ['required'],
            'confirm_password' => ['required'],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            if (Auth::guard('admin')->check()) {
                $attempts = !Hash::check($request->password, Auth::guard('admin')->user()->password);
            } elseif (Auth::guard('user')->check()) {
                $attempts = !Hash::check($request->password, Auth::guard('user')->user()->password);
            }
            if ($attempts) {
                return response()->json([
                    'message' => 'Maaf, Password yang anda inputkan tidak cocok dengan password anda saat ini',
                    'status' => false,
                ], 200);
            } else {
                if ($request->current_password == $request->confirm_password) {
                    if (Auth::guard('admin')->check()) {
                        Admin::where('id', Auth::guard('admin')->user()->id)->update(array('password' => Hash::make($request->confirm_password)));
                    } elseif (Auth::guard('user')->check()) {
                        Admin::where('id', Auth::guard('user')->user()->id)->update(array('password' => Hash::make($request->confirm_password)));
                    }
                    return response()->json([
                        'message' => 'Password berhasil diperbarui',
                        'status' => true,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Password baru anda tidak sama dengan konfirmasi password',
                        'status' => false,
                    ], 200);
                }
            }
        }
    }
}
