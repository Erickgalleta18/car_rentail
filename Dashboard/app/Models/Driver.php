<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table="drivers";
    protected $primaryKey="id";
    protected $fillable = [
        'user_id',
        'licence_number',
        'licence_img'
    ];
}
