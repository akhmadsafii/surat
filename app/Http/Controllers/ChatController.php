<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        dd($request);
        $data = $request->toArray();
        Chat::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Komentar berhasil disimpan',
            'status' => true,
        ], 200);
    }
}
