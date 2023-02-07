<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Models\Message;
use Illuminate\Http\Request;

class DispositionController extends Controller
{
    public function create($code)
    {
        session()->put('title', 'Kirim Disposisi');
        $message = Message::where('code', $code)->first();
        $instructions = Instruction::where('status', '!=', 0)->get();
        return view('content.messages.inbox.dispositions.v_create_disposition', compact('message', 'instructions'));
    }
}
