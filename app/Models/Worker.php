<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = 'workers';
    protected $guarded = false;

    protected static function newFactory()
    {
        return \Database\Factories\WorkerFactory::new();
    }
}
