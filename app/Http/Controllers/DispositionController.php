<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\StatusHelper;
use App\Models\Chat;
use App\Models\Disposition;
use App\Models\Instruction;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DispositionController extends Controller
{
    public function in(Request $request)
    {
        dd('disposisi');
    }
    public function out(Request $request)
    {
        session()->put('title', 'Disposisi Keluar');
        if (Auth::guard('admin')->check()) {
            $all_dispositions = Disposition::where([
                ['from_position', 'admin'],
                ['from', Auth::guard('admin')->user()->id],
            ])
                ->groupBy(['id_message', 'received_position']) // group by query
                ->get()
                ->groupBy('id_message');
        }
        if (Auth::guard('user')->check()) {
            $data['from'] = Auth::guard('user')->user()->id;
            $data['from_position'] = Auth::guard('user')->user()->position;
        }
        // dd($dispositions);
        $dispositions = [];
        foreach ($all_dispositions as $key => $ds) {
            $disposisi = [];
            foreach ($ds as $disp) {
                $disposisi[] = $disp;
            }
            $message = Message::find($key);
            $dispositions[] = [
                'from' => $message['to_position'],
                'number' => $message['number'],
                'code' => $message['code'],
                'date' => $message['date'],
                'disposisi' => $disposisi
            ];
        }
        // dd($dispositions);

        if ($request->ajax()) {
            return DataTables::of($dispositions)->addIndexColumn()
                ->editColumn('disposition', function ($row) {
                    return '<a href="' . route('admin.message.inbox.disposition.detail', $row['code']) . '"><span class="m--font-bold text-dark">' . Helper::get_job($row['from']) . '</span>
                    <br>
                    <span class="text-muted">Nomor Surat : ' . $row['number'] . '</span>
                    </a>
                    <br>
                    Surat: <a href="#">Klik disini</a>';
                })
                ->editColumn('received', function ($dis) {
                    $received = '';
                    foreach ($dis['disposisi'] as $disposisi) {
                        $received .= '<p class="mb-0">' . Helper::get_job($disposisi['received_position']) . '<span class="m--font-bold m--font-' . StatusHelper::dispositions($disposisi['status'])['class'] . ' ml-3">' . StatusHelper::dispositions($disposisi['status'])['message'] . '</span></p> ';
                    }
                    return '<a href="' . route('admin.message.inbox.disposition.detail', $dis['code']) . '">' . $received . '</a>';
                })
                ->editColumn('from', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.disposition.detail', $message['code']) . '">' . $message['from'] . '</a>';
                })
                ->addColumn('date', function ($message) {
                    return '<a class="text-dark" href="' . route('admin.message.inbox.disposition.detail', $message['code']) . '"><b>' . DateHelper::getTanggal($message['date']) . '</b></a>';
                })
                ->editColumn('instruction', function ($message) {
                    $id_instruction = $message['disposisi'][0]['id_instruction'];

                    if ($id_instruction != null) {
                        $instruksi = '';
                        foreach (explode(',', $id_instruction) as $ins) {
                            $inst = Instruction::find($ins);
                            $instruksi .= '<p class="mb-0">' . $inst['name'] . '</p>';
                        }
                    } else {
                        $instruksi = '-';
                    }
                    return '<a class="text-dark" href="' . route('admin.message.inbox.disposition.detail', $message['code']) . '">' . $instruksi . '</a>';
                })
                ->rawColumns(['disposition', 'instruction', 'date', 'from', 'received'])
                ->make(true);
        }
        return view('content.messages.inbox.dispositions.v_disposition');
    }

    public function create($code)
    {
        session()->put('title', 'Kirim Disposisi');
        $message = Message::where('code', $code)->first();
        $instructions = Instruction::where('status', '!=', 0)->get();
        return view('content.messages.inbox.dispositions.v_create_disposition', compact('message', 'instructions'));
    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        $data['id_instruction'] = implode(',', $request['id_instruction']);
        if (Auth::guard('admin')->check()) {
            $data['from'] = Auth::guard('admin')->user()->id;
            $data['from_position'] = 'admin';
        }
        if (Auth::guard('user')->check()) {
            $data['from'] = Auth::guard('user')->user()->id;
            $data['from_position'] = Auth::guard('user')->user()->position;
        }
        foreach ($request['received_position'] as $pos) {
            $data['received_position'] = $pos;
            Disposition::updateOrCreate(
                ['id' => $request->id],
                $data
            );
        }

        return response()->json([
            'message' => 'Disposisi berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function detail($code)
    {
        // dd($code);
        session()->put('title', 'Detail Disposisi');
        $message = Message::where('code', $code)->first();
        $all_dist = Disposition::where('id_message', $message['id'])->get();
        $ad = [];
        foreach ($all_dist as $ald) {
            $ad[] = Helper::get_job($ald['received_position']);
        }
        $message['received'] = $ad;
        $disposition = Disposition::where('id_message', $message['id'])->first();
        $instruction = [];
        foreach (explode(',', $disposition['id_instruction']) as $ins) {
            $instr = Instruction::find($ins);
            $instruction[] = $instr['name'];
        }
        $disposition['instruction'] = $instruction;
        $chats = Chat::where('id_message', $message['id'])->get();
        // dd($chats);
        return view('content.messages.inbox.dispositions.v_detail_disposition', compact('message', 'disposition', 'chats'));
    }
}
