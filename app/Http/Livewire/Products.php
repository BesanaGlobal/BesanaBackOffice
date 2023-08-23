<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\Line;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products=[];
    public $subTotal;
    public $session=2;
    public $total;
    public $taxes = 0;
    public $shipping = 0;
    public $shippingfront = 0;

    public $onzas=0;
    public $onzasfront = 0;
    public $registrado = 0;
    public $puntosTemporal=0;
    public $state;
    public function render()
    {
      
        $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idAffiliated)->first();
        $this->state = $afiliado->State;
      
        $this->total=\Cart::session(Auth()->user()->idUser)->getContent()->count();
        $content = \Cart::session(Auth()->user()->idUser)->getContent();
        // dd($content);
        if ($this->total>0) {
          foreach ($content as $value) {
            
              $this->shippingfront = $value->attributes->shipping;
              $this->onzasfront = $value->attributes->onzas;
        // dd($value);
          }
        }
        $lines=Line::all();
        $excludedIds = [5];
        $this->products=Product::whereNotIn('idLine',$excludedIds)->get();;
      // dd($this->products);
        return view('livewire.products', compact('afiliado'))->extends('layout.side-menu')
                ->section('subcontent');
    }
    public function onzasPrice( $val )
      {
        $this->totalOnzas = $val;

        switch ($val) {
          case 2:
            $this->shipping = 7;
            break;
            case 4:
            $this->shipping = 14;
              break;
        }
      }

      private function obtenerOnzas($id){
    $value = $id;
        switch ($value) {
            case 0:
                $this->onzas=3;
              break;
            case 1:
                $this->onzas=3; 
                break;
            case 2:
                $this->onzas=3;
                break; 
            case 3:
                $this->onzas=2;
                break;
            case 4:
                $this->onzas=3;
                break;  
            case 5:
                $this->onzas=8;
                break;
            case 6:
                $this->onzas=5;
                break;
            case 7:
                $this->onzas=5;
                break; 
        }
      }
    public function addCart($id, $cant=1 ){

    $this->obtenerOnzas($id);
    // if ($this->onzas < 32 ) {
    //     $this->shipping = 7;
    //   }else{
    //     $residual = intval($this->onzas - (31+$this->registrado));
    //     $this->registrado += $residual;
    //     $this->shipping += $residual;
    //   }
        

   
    
         $cantTem=\Cart::session(Auth()->user()->idUser)->getContent()->count();
     
     
         $descuento = $this->products[$id]['price']*0.15;
         $price=number_format(floatval($this->products[$id]['price'] - $descuento),2);

         //tax
         switch (strtoupper($this->state)) {
          case 'NEVADA':
              $this->taxes=number_format(floatval((8.375*$price)/100),2);
              
            break;
          default:
              $this->taxes=0;
            break;
        
        }
         \Cart::session(Auth()->user()->idUser)->add(array(
            'id' => $this->products[$id]['idProd'], // inique row ID
            'name' => $this->products[$id]['name'],
            'price' => $price,
            'quantity' => $cant,
             'attributes'=>array(
               'img'=>$this->products[$id]['img'],
               'puntos'=>$this->products[$id]['puntos'],
               'onzas'=>number_format(floatval($this->onzas),2),
               'tax'=>$this->taxes
             ),
            
        ));
    $this->puntosTemporal = $this->products[$id]['puntos'];
          $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent($id)->count();
        $language=session()->get('locale');
          if ($this->cantidadProductos==$cantTem) {
                if ($language=='en') {
                  $this->dispatchBrowserEvent('noty', ['msg' => 'Product Updated']);
                }else{
                  $this->dispatchBrowserEvent('noty', ['msg' => 'Producto Actualizado la cantidad']);

                }
          
          $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent($id)->count();
  
          }else{
                if ($language=='en') {
                  $this->dispatchBrowserEvent('noty', ['msg' => 'Add new Product!']);
              }else{
              $this->dispatchBrowserEvent('noty', ['msg' => 'Producto nuevo agregado!']);

              }
          }
            
            // $this->dispatchBrowserEvent('noty', ['msg' => 'Producto nuevo agregado!']);
  
          
        
         
          
      }
  
      public function ClearCart()
      {
        \Cart::session(Auth()->user()->idUser)->clear();
        $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent()->count();
    $this->shippingfront = 0;
    $this->onzasfront = 0;
  
      }
}
