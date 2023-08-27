<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $table ='Points';
    public $timestamps = false;
    protected $primaryKey = 'idProd';
    protected $fillable = [
        
        'idUser',
        'puntos',
        'fechaQuery'
    ];
}
