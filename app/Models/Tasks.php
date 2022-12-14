<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'service',
        'date_registration',
        'date_start',
        'date_limit',
        'id_user',
        'id_project',
        'id_version',
        'description',
        'solution',
        'name_files',
        'name_folder',
        '_token',
    ];
}
