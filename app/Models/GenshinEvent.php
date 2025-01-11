<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenshinEvent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'description',
        'start_date',
        'end_date',
    ];
}
