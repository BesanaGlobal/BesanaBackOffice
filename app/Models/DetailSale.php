<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;
    protected $table ='DetailSale';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'id_sale',
        'id_product',
        'precioVenta',
        'cantidad',
        'subtotal',
        'NameProduct',
        'Tax'
    ];

    public function sale(): BelongsTo
   {
       return $this->belongsTo(Sale::class);
   }

   public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'idProd', 'id_product');
    }
}
