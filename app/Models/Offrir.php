<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offrir extends Model
{
    use HasFactory;
    
    protected $table = 'offrir';
    protected $fillable = ['VIS_MATRICULE', 'RAP_NUM', 'MED_DEPOTLEGAL', 'OFF_QTE'];
    public $timestamps = false;

    public function rapportVisite(){
        return $this->belongsTo(RapportVisite::class);
    }
}
