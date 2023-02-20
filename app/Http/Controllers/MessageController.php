<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function inbox()
    {
        // dd('tampilan pesan');
        session()->put('title', 'Surat Masuk');
        return view('content.messages.inbox.v_inbox');
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
}
