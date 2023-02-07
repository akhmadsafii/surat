<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function index(Request $request)
    {
        // dd('instruksi');
        session()->put('title', 'Instruksi Disposisi Surat');
        $instruction = Instruction::where('status', '!=', 0)->get();
        return view('content.instruction.v_instruction', compact('instruction'));
    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        if ($request['code']) {
            if ($request['id']) {
                $data['code'] = $request['code'];
            } else {
                $data['code'] = str_slug($data['code']) . '-' . Helper::str_random(5);
            }
        } else {
            $data['code'] = str_slug($data['name']) . '-' . Helper::str_random(5);
        }
        Instruction::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Instruksi berhasil disimpan',
            'status' => true,
        ], 200);
    }
}
