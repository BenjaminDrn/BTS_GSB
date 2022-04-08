<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapportVisite extends Model
{
    use HasFactory;

    protected $table = 'rapport_visite';
    protected $fillable = ['VIS_MATRICULE', 'PRA_NUM', 'RAP_DATE', 'RAP_BILAN', 'RAP_MOTIF'];
    public $timestamps = false;

    public function offrir(){
        return $this->hasMany(Offrir::class);
    }
}
