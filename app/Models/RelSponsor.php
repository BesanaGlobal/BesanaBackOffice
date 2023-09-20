<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class RelSponsor extends Model
{
    use HasFactory;
    protected $table ='relsponsor';
     public $timestamps = false;
     protected $primaryKey = 'idRel';

    protected $fillable = [
      
        'idAffiliatedParent',
        'idAffiliatedChild',

    ];

    public function afiliado(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class,'idAffiliatedParent');
    }
}
