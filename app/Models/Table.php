<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'table_number'
    ];
}
