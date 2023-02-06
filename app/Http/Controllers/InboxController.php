<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\ImageHelper;
use App\Models\Message;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InboxController extends Controller
{
    public function inbox(Request $request)
    {
        session()->put('title', 'Surat Masuk');
        $messages = Message::query();
        if ($request->ajax()) {
            return DataTables::of($messages)->addIndexColumn()
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
                ->editColumn('regard', function ($message) {
                    return '<a href="' . route('admin.message.inbox.detail', ['c' => encrypt($message['id'])]) . '"><b>' . $message['regard'] . '</b><br><small>' . $message['category'] . '</small></a>';
                })
                ->editColumn('from', function ($message) {
                    return '<a href="' . route('admin.message.inbox.detail', ['c' => encrypt($message['id'])]) . '">' . $message['from'] . '</a>';
                })
                ->addColumn('received', function ($message) {
                    return '<a href="' . route('admin.message.inbox.detail', ['c' => encrypt($message['id'])]) . '"><b>' . $message['regard'] . '</b><br><small>' . $message['category'] . '</small></a>';
                })
                ->editColumn('date', function ($message) {
                    return DateHelper::getTanggal($message['date']);
                })
                ->rawColumns(['action', 'regard', 'date', 'from'])
                ->make(true);
        }
        return view('content.messages.inbox.v_inbox');
    }

    public function detail(Request $request)
    {
        // dd($request);
    }

    public function create()
    {
        // dd('create');
        session()->put('title', 'Tambah Surat Masuk');
        return view('content.messages.inbox.v_create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $request->toArray();
        if (!empty($request->doc_1)) {
            $data = ImageHelper::upload_drive($request, 'doc_1', 'document', $data);
        }
        // dd($data);
        if (!empty($request->doc_2)) {
            $data = ImageHelper::upload_drive($request, 'doc_2', 'document', $data);
        }
        if (!empty($request->doc_3)) {
            $data = ImageHelper::upload_drive($request, 'doc_2', 'document', $data);
        }
        if (!empty($request->original_file)) {
            $data = ImageHelper::upload_drive($request, 'original_file', 'document', $data);
        }
        Message::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Kategori berhasil disimpan',
            'status' => true,
        ], 200);
    }
}
