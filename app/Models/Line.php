<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;
    protected $table ='lineProduct';
    protected $primaryKey = 'idLine';

    protected $fillable = [
        
        'Line'
    ];

    public function Product(){
       return $this->hasMany(Product::class,'idProd');
    }
}
