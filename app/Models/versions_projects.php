<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class versions_projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comments',
        'project_id'
    ];
}
