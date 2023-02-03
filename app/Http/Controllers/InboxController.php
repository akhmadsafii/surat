<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function inbox()
    {
        session()->put('title', 'Surat Masuk');
        return view('content.messages.inbox.v_inbox');
    }

    public function create()
    {
        // dd('create');
        session()->put('title', 'Tambah Surat Masuk');
        return view('content.messages.inbox.v_create');
    }
}
