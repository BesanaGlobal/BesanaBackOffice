<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arbol extends Model
{
    use HasFactory;
    protected $table ='arbol';
    protected $primaryKey = 'id';
    public $timestamps = false;
    

   protected $fillable = [
     
       'idFhater',
       'idSon',

   ];

//    public function affiliatePadre(): HasMany
//    {
//        return $this->hasMany(Affiliate::class, 'idFhater', 'idAffiliated');
//    }

//    public function affiliateHijo(): HasMany
//    {
//        return $this->hasMany(Affiliate::class, 'idAffiliated');
//    }

    public function affiliado(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class,'idFhater');
    }

}
