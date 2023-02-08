<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OutboxController extends Controller
{
    public function inbox(Request $request)
    {
        session()->put('title', 'Surat Keluar');
        $messages = Message::query();
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
                ->rawColumns(['status', 'regard', 'date', 'from', 'received'])
                ->make(true);
        }
        return view('content.messages.outbox.v_outbox');
    }
}
