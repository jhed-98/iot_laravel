<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    const EST_ERROR = 0;
    const EST_1 = 1;
    const EST_2 = 2;
    const EST_3 = 3;
    const EST_4 = 4;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
