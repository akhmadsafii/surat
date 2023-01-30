<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateLetter extends Model
{
    use HasFactory;
    protected $table = 'template_letters';

    protected $guarded = [];
}
