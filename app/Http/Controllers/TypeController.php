<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Template;
use App\Models\TemplateLetter;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeController extends Controller
{
    public function index()
    {
        return view('content.types.v_type');
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $request->toArray();
        if (!$request->id) {
            $data['code'] = str_slug($data['name']) . '-' . Helper::str_random(5);
        }
        // if($request['template']){
        //     $data['template'] = json_encode($data['template']);
        // }
        Type::updateOrCreate(
            ['id' => $request->id],
            $data
        );
        return response()->json([
            'message' => 'Tipe berhasil terkirim',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        $type = Type::find($request->id);
        return response()->json($type);
    }

    public function delete(Request $request)
    {
        $admin = Type::find($request->id);
        $admin->update(array('status' => 0));
        return response()->json([
            'message' => 'Tipe berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function more($code)
    {
        $template = Template::where('status', 1)->get();
        $type = Type::where('code', $code)->first();
        $type_template = [];
        if($type['template'] != null){
            $type_template = json_encode($type['template'], JSON_FORCE_OBJECT);
            $type_template = json_decode($type_template, true);
        }
        session()->put('title', $type['name']);
        return view('content.types.v_detail', compact('template', 'type', 'type_template'));
    }
}
