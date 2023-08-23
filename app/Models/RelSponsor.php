<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelSponsor extends Model
{
    use HasFactory;
    protected $table ='relSponsor';
     public $timestamps = false;
     protected $primaryKey = 'idRel';

    protected $fillable = [
      
        'idAffiliatedParent',
        'idAffiliatedChild',

    ];
}
