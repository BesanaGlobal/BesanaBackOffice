<?php

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/products', function () {
    return Product::all();
});

Route::get('/{id}',function($id){
    return Product::where('idProd',$id)->first();
});

Route::post('/Buy' ,[ApiController::class,'Buy']);
Route::post('/Sponsor',[ApiController::class,'Sponsor']);



