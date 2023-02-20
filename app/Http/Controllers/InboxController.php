<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Helpers\StatusHelper;
use App\Models\Inbox;
use App\Models\Message;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        // dd('internal');
        session()->put('title', 'Surat Masuk');
        $messages = Inbox::all();
        // dd($messages);
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
        $message = Inbox::where('code', $id)->first();
        $position = [];
        foreach (Helper::job_array() as $key => $pst) {
            $position[] = '"' . $pst . '"';
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
        // dd($request);
        $data = $request->toArray();
        $data['status'] = 2;
        $doc = [];
        if ($request->hasFile('doc')) {
            foreach ($request->doc as $key => $document) {
                $path_doc = ImageHelper::file_multiple_drive($document, 'document');
                array_push($doc, $path_doc);
            }
            $data['doc'] = json_encode($doc);
        }
        $original_file = [];
        if ($request->hasFile('original_file')) {
            foreach ($request->original_file as $key => $file) {
                $path_file = ImageHelper::file_multiple_drive($file, 'document');
                array_push($original_file, $path_file);
            }
            $data['original_file'] = json_encode($original_file);
        }

        $data['code'] = str_slug($data['number']) . '-' . Helper::str_random(5);
        $data['status_disposition'] = 0;
        // dd($data);

        Inbox::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Pesan masuk berhasil dibuat',
            'status' => true,
        ], 200);
    }

    public function save(Request $request)
    {
        Inbox::where('id', $request->pk)->update([$request->name => $request->value]);
        return response()->json([
            'message' => 'Inbox berhasil terkirim',
            'status' => true,
        ], 200);
    }

    public function update(Request $request)
    {
        $data = $request->toArray();
        $inbox = Inbox::find($request['id']);
        $doc = json_decode($inbox['doc']);
        if ($request->hasFile('doc')) {
            foreach ($request->doc as $key => $document) {
                $path_doc = ImageHelper::file_multiple_drive($document, 'document');
                array_push($doc, $path_doc);
            }
            $data['doc'] = json_encode($doc);
        }
        $original_file = json_decode($inbox['original_file']);
        if ($request->hasFile('original_file')) {
            foreach ($request->original_file as $key => $file) {
                $path_file = ImageHelper::file_multiple_drive($file, 'document');
                array_push($original_file, $path_file);
            }
            $data['original_file'] = json_encode($original_file);
        }

        $inbox->update($data);

        // Inbox::updateOrCreate(
        //     ['id' => $request->id],
        //     $data
        // );
        return response()->json([
            'message' => 'Pesan masuk berhasil dibuat',
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

    public function download($file)
    {
        $file = decrypt($file);
        return ImageHelper::download_drive($file);
    }

    public function delete_file(Request $request)
    {
        $data = [];
        $inbox = Inbox::find(decrypt($request['key']));
        $coloumn = json_decode($inbox[$request['coloumn']], true);
        if (($key = array_search(decrypt($request['name']), $coloumn)) !== false) {
            unset($coloumn[$key]);
            ImageHelper::delete_drive(decrypt($request['name']));
        }
        $data[$request['coloumn']] = json_encode($coloumn);
        $inbox->update($data);
        return redirect()->back();
    }
}
