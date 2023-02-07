<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Models\Message;
use App\Models\User;
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
                ->addColumn('status', function ($row) {
                    return '<span class="m--font-bold m--font-primary">Retail</span>';
                })
                ->editColumn('regard', function ($message) {
                    return '<a href="' . route('admin.message.inbox.detail', ['number' => $message['number']]) . '"><b>' . $message['regard'] . '</b><br><small>' . $message['category'] . '</small></a>';
                })
                ->editColumn('from', function ($message) {
                    return '<a href="' . route('admin.message.inbox.detail', ['number' => $message['number']]) . '">' . $message['from'] . '</a>';
                })
                ->addColumn('received', function ($message) {
                    $user = User::where([
                        ['position', $message['to_position']],
                        ['status', '!=', 0],
                    ])->first();
                    return '<a href="' . route('admin.message.inbox.detail', ['number' => $message['number']]) . '"><b>' . Helper::get_job($message['to_position']) . '</b><br><small>' . $user['name'] . '</small></a>';
                })
                ->editColumn('date', function ($message) {
                    return DateHelper::getTanggal($message['date']);
                })
                ->rawColumns(['status', 'regard', 'date', 'from', 'received'])
                ->make(true);
        }
        return view('content.messages.inbox.v_inbox');
    }

    public function detail(Request $request)
    {
        // dd($_GET['number']);
        $message = Message::where('number', $_GET['number'])->first();
        $position = [];
        foreach (Helper::job_array() as $key => $pst) {
            $position[] = '"' . $key . '"';
        }
        // dd($position);
        // dd($message);
        return view('content.messages.inbox.v_detail', compact('message', 'position'));
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
            'message' => 'Pesan berhasil terkirim',
            'status' => true,
        ], 200);
    }

    public function save(Request $request)
    {
        // dd($request);
        $result = Message::where('id', $request->pk)->update([$request->name => $request->value]);
        return response()->json([
            'message' => 'Pesan berhasil terkirim',
            'status' => true,
        ], 200);
    }
}
