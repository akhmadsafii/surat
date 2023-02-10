<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Template Surat');
        $templates = Template::where('status', '!=', 0)->get();
        return view('content.templates.v_template', compact('templates'));
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
        Template::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Template berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function delete(Request $request)
    {
        // dd($request);
        $id = $request->id;
        Template::whereIn('id', $id)->update(['status' => 0]);
        return response()->json([
            'message' => 'Template berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
