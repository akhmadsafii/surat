<?php

namespace App\Http\Controllers;

use App\Models\TemplateLetter;
use Illuminate\Http\Request;

class TemplateLetterController extends Controller
{
    public function index()
    {
        // dd('tampilan template surat');
        $template = TemplateLetter::where('status', '!=', 0)->get();
        return view('content.templates.letter.v_template_letter', compact('template'));
    }
}
