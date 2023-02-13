<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->toArray();
        if (Auth::guard('admin')->check()) {
            $data['id_user'] = Auth::guard('admin')->user()->id;
            $data['position'] = 'admin';
        }
        if (Auth::guard('user')->check()) {
            $data['id_user'] = Auth::guard('user')->user()->id;
            $data['position'] = Auth::guard('user')->user()->position;
        }
        Chat::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Komentar berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function delete(Request $request)
    {
        $chat = Chat::find($request->id);
        $chat->update(array('status' => 0));
        return response()->json([
            'message' => 'Komentar berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
