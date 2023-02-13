<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Helpers\StatusHelper;
use App\Models\Message;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InboxController extends Controller
{
    public function inbox(Request $request)
    {
        session()->put('title', 'Surat Masuk');
        // $messages = Message::where('category', 'in')->get();
        $messages = Message::where([
            ['to_position', session('position')],
            // ['category', 'in'],
        ]);
        if ($request->ajax()) {
            return DataTables::of($messages)->addIndexColumn()
                ->editColumn('status', function ($row) {
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
        return view('content.messages.inbox.v_inbox');
    }

    public function detail($id)
    {
        // dd($_GET['number']);
        // dd(Helper::encode(1));
        $message = Message::where('code', $id)->first();
        // dd($message['number']);
        // dd(str_slug($message['number']));
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
        $type = Type::where('status', '!=', 0)->get();
        session()->put('title', 'Tambah Surat Masuk');
        return view('content.messages.inbox.v_create', compact('type'));
    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        unset($data['action']);

        if ($request['category'] == 'in') {
            $data['number'] = $request['number'];
            $data['status'] = 2;
        } else {
            $cek = Message::where([
                ['type', $request->type],
                ['category', 'out'],
            ])->orderBy('id', 'asc')->get()->last();
            if ($cek == null) {
                $no_agenda = 1;
            } else {
                $no_agenda = $cek['no_agenda'] + 1;
            }
            $data['no_agenda'] = $no_agenda;
            $code_urgent = Helper::getInital($request['urgency_letter']);
            $type = Type::find($request->type);
            $data['number'] = $code_urgent . '/' . $type['code_type'] . '/' . str_pad($no_agenda, 3, '0', STR_PAD_LEFT) . '/' . Helper::getRomawi(now()->month) . '/' . now()->year;
            if ($request['action'] == 'draft') {
                $data['status'] = 4;
            } else {
                $data['status'] = 3;
            }
        }
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

        $data['code'] = str_slug($data['number']) . '-' . Helper::str_random(5);
        $data['status_disposition'] = 0;
        if (Auth::guard('admin')->check()) {
            $data['from_user'] = Auth::guard('admin')->user()->id;
            $data['from_position'] = 'admin';
        }
        if (Auth::guard('user')->check()) {
            $data['from_user'] = Auth::guard('user')->user()->id;
            $data['from_position'] = Auth::guard('user')->user()->position;
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
        Message::where('id', $request->pk)->update([$request->name => $request->value]);
        return response()->json([
            'message' => 'Pesan berhasil terkirim',
            'status' => true,
        ], 200);
    }

    public function delete(Request $request)
    {
        $message = Message::find($request->id);
        $message->update(array('status' => 0));
        return response()->json([
            'message' => 'Inbox berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
