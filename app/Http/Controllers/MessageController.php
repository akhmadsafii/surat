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
}
