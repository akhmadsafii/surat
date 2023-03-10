<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\StatusHelper;
use App\Models\Message;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OutboxController extends Controller
{
    public function outbox(Request $request)
    {
        session()->put('title', 'Surat Keluar');
        // dd(session('position'));
        $messages = Message::where([
            ['from_position', session('position')],
            ['from_user', session('id')],
            ['status', '!=', 4],
            ['category', 'out'],
        ]);
        // dd($messages);
        if ($request->ajax()) {
            return DataTables::of($messages)->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $row['code']) . '"><span class="m--font-bold m--font-' . StatusHelper::messages($row['status'])['class'] . '">' . StatusHelper::messages($row['status'])['message'] . '</span></a>';
                })
                ->editColumn('regard', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '"><b>' . $message['regard'] . '</b><br><small>' . $message['nature_letter'] . '</small></a>';
                })
                ->editColumn('from', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '">' . $message['from'] . '</a>';
                })
                ->addColumn('received', function ($message) {
                    $user = User::where([
                        ['position', $message['to_position']],
                        ['status', '!=', 0],
                    ])->first();
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '"><b>' . Helper::get_job($message['to_position']) . '</b><br><small>' . $user['name'] . '</small></a>';
                })
                ->editColumn('date', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '">' . DateHelper::getTanggal($message['date']) . '</a>';
                })
                ->editColumn('classification', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '">' . ucfirst($message['classification']) . '</a>';
                })
                ->rawColumns(['status', 'regard', 'date', 'from', 'received', 'classification'])
                ->make(true);
        }
        return view('content.messages.outbox.v_outbox');
    }

    public function draft(Request $request)
    {
        session()->put('title', 'Draft');
        $messages = Message::where([
            ['from_position', 'admin'],
            ['status', 4]
        ]);
        if ($request->ajax()) {
            return DataTables::of($messages)->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $row['code']) . '"><span class="m--font-bold m--font-' . StatusHelper::messages($row['status'])['class'] . '">' . StatusHelper::messages($row['status'])['message'] . '</span></a>';
                })
                ->editColumn('number', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '"><b>' . $message['number'] . '</b><br><small>Perihal :' . $message['regard'] . '</small></a>';
                })
                ->editColumn('from', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '">' . $message['from'] . '</a>';
                })
                ->addColumn('received', function ($message) {
                    $user = User::where([
                        ['position', $message['to_position']],
                        ['status', '!=', 0],
                    ])->first();
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '"><b>' . Helper::get_job($message['to_position']) . '</b><br><small>' . $user['name'] . '</small></a>';
                })
                ->editColumn('date', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '">' . DateHelper::getTanggal($message['date']) . '</a>';
                })
                ->editColumn('ttd', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.detail', $message['code']) . '">' . strtoupper($message['ttd']) . '</a>';
                })
                ->rawColumns(['status', 'number', 'date', 'from', 'received', 'ttd'])
                ->make(true);
        }
        return view('content.messages.drafts.v_draft');
    }

    public function create()
    {
        // dd('create');
        $type = Type::where('status', '!=', 0)->get();
        session()->put('title', 'Tambah Surat Keluar');
        return view('content.messages.inbox.v_create', compact('type'));
    }
}
