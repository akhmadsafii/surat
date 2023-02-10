<?php

namespace App\Http\Controllers;

use App\Models\Disposition;
use App\Models\Instruction;
use App\Models\Message;
use Illuminate\Http\Request;

class DispositionController extends Controller
{
    public function index(Request $request)
    {
        dd('disposisi');
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
}
