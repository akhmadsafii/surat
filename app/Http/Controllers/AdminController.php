<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\ImageHelper;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Admin');
        $admins = Admin::where('status', '!=', 0);
        if ($request->ajax()) {
            return DataTables::of($admins)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit Detail</a>
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(' . $row['id'] . ')"><i class="la la-trash"></i> Hapus</a>
                        </div>
                    </span>';
                    return $btn;
                })
                ->editColumn('last_login', function ($admin) {
                    return DateHelper::getHoursMinute($admin['last_login']);
                })
                ->rawColumns(['action', 'last_login'])
                ->make(true);
        }
        // dd($admin);
        return view('content.admins.v_admin');
    }

    public function detail(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin['avatar'] = $admin['file'] ? asset($admin['file']) : 'https://via.placeholder.com/150';
        return response()->json($admin);
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Admin',
            'phone' => 'Telepon Admin',
        ];

        $max_size = 'max:' . env('CONFIG_MAX_UPLOAD');
        $mimes = 'mimes:' . str_replace('|', ',', env('CONFIG_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            // 'username' => ['required', "regex:/^[a-zA-Z .,']+$/"],
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

    public function delete(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->update(array('status' => 0));
        return response()->json([
            'message' => 'Admin berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
