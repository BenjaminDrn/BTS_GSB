<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Visiteurs extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'VIS_ADRESSE',
        'VIS_CP',
        'VIS_VILLE',
    ];

    public $timestamps = false;
}
