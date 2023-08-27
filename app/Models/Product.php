<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    public $timestamps = false;
    protected $primaryKey = 'idProd';
    protected $fillable = [
        
        'name',
        'img',
        'description',
        'idLine',
        'price',
        'active',
        'puntos',
        'sku',
        'directions',
        'key_ingredients',
        'ingredients',
        'puntosWebsite'
    ];

    public function linea()
    {
        return $this->belongsTo(Line::class, 'idLine');
    }

    public function saleProduct(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function detailSale(): BelongsTo
   {
       return $this->belongsTo(DetailSale::class, 'id_product');
   }

}
