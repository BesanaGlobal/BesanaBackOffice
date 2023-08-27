<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;
    protected $table ='sales';
    protected $primaryKey = 'idSale';
    public $timestamps = false;
    
    protected $fillable = [
        
        'idWebsite',
        'idProd',
        'datetimeb',
        'idAffiliated',
        'price',
        'ActivatedBuy',
        'TipoPago',
        'webShop',
        'WebNameClient',
        'WebEmailClient',
        'Shipping'
    ];


    public function webSite(): HasOne
    {
        return $this->hasOne(Website::class, 'idWebsite');
    }

    public function detailSales(): HasMany
    {
        return $this->hasMany(DetailSale::class, 'id_sale');
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class, 'idAffiliated');
    }


}
