<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table ='Wallet';
    public $timestamps = false;
    protected $fillable = [
      
        'id_user',
        'Week',
        'Month',
        'Date_Pay',
        'Estado'

    ];

}
