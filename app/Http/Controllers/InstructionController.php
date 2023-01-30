<?php

namespace App\Http\Controllers;

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
        Instruction::updateOrCreate(
            ['id' => $request->id],
            $request->toArray()
        );
        return response()->json([
            'message' => 'Instruksi berhasil disimpan',
            'status' => true,
        ], 200);
    }
}
