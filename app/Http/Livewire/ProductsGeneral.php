<?php

namespace App\Http\Livewire;

use App\Models\Line;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductsGeneral extends Component
{
    use WithFileUploads; 

    public $productName;
    public $lineProduct;
    public $selectedLineProduct;
    public $priceProduct;
    public $pointsProductOffice;
    public $pointsProductWeb;
    public $skuProduct;
    public $descriptionProduct;
    public $directionsProduct;
    public $ingredients;
    public $image;

    protected $rules = [
        'productName'                => 'required',
        'selectedLineProduct'        => 'required',
        'priceProduct'               => 'required',
        'pointsProductOffice'        => 'required',
        'pointsProductWeb'           => 'required',
        'skuProduct'                 => 'required',
        'descriptionProduct'         => 'required',
        'directionProduct'           => 'required',
        'ingredients'                => 'required',
       
    ];

    protected $messages = [
        'productName.required'                => 'El nombre del producto es requerido',
        'selectedLineProduct.required'        => 'La linea del producto es requerida',
        'priceProduct.required'               => 'Precio del producto es requerido',
        'pointsProductOffice.required'        => 'Puntos para el producto en el backOffice es requerido',
        'pointsProductWeb.required'           => 'Puntos para el producto en el webSite es requerido',
        'skuProduct.required'                 => 'SKU del producto es requerido',
        'descriptionProduct.required'         => 'Descripción del producto es requerido',
        'directionProduct.required'           => 'Dirección del producto es requerida',
        'ingredients.required'                => 'Ingredientes del producto es requerido',
    ];


    public function mount(){
        $this->lineProduct = Line::get();
    }

    public function render()
    {
        return view('livewire.products-general')->extends('layout.side-menu')->section('subcontent');
    }

    public function create(){
        $data                          = $this->validate();
        $urlImagen                     = $this->imagen->store('public/img/products');

        Product::create([
            'name'              => $data['nameProduct'],
            'img'               => $urlImagen,
            'description'       => $data['descriptionProduct'],
            'idLine'            => $data['selectedLineProduct'],
            'price'             => $data['priceProduct'],
            'active'            => 1,
            'puntos'            => $data['pointsProductOffice'],
            'sku'               => $data['skuProduct'],
            'directions'        => $data['directionProduct'],
            'key_ingredients'   => $data['ingredients'],
            'ingredients'       => $data['ingredients'],
            'puntosWebsite'     => $data['pointsProductWeb'],
        ]);

        // Puedes agregar lógica adicional después de la inserción si es necesario

        // Limpia los campos después de la inserción
        $this->reset(['campo1', 'campo2']);

    }
}
