<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\Line;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
  public $products        = [];
  public $session         = 2;
  public $taxes           = 0;
  public $shipping        = 0;
  public $shippingfront   = 0;
  public $onzas           = 0;
  public $onzasfront      = 0;
  public $registrado      = 0;
  public $puntosTemporal  = 0;
  public $subTotal;
  public $total;
  public $state;
  public $current;

  protected $listeners = [
    'changeCurrent' => 'changeCurrent',
  ];

  public function changeCurrent($value)
  {
    $this->current = $value;
  }

  public function render()
  {
    $afiliado     = Affiliate::where('idAffiliated', Auth()->user()->idAffiliated)->first();
    $this->state  = $afiliado->State;
    $this->total  = \Cart::session(Auth()->user()->idUser)->getContent()->count();
    $content      = \Cart::session(Auth()->user()->idUser)->getContent();

    if ($this->total > 0) {
      foreach ($content as $value) {
        $this->shippingfront  = $value->attributes->shipping;
        $this->onzasfront     = $value->attributes->onzas;
      }
    }

    $lines          = Line::all();
    $excludedIds    = [5];
    $this->products = Product::whereNotIn('idLine', $excludedIds)->get();

    return view('livewire.products', compact('afiliado'))->extends('layout.side-menu')->section('subcontent');
  }

  public function onzasPrice($val)
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

  private function obtenerOnzas($id)
  {
    $value = $id;
    switch ($value) {
      case 0:
        $this->onzas = 3;
      break;
      case 1:
        $this->onzas = 3;
      break;
      case 2:
        $this->onzas = 3;
      break;
      case 3:
        $this->onzas = 2;
      break;
      case 4:
        $this->onzas = 3;
      break;
      case 5:
        $this->onzas = 8;
      break;
      case 6:
        $this->onzas = 5;
      break;
      case 7:
        $this->onzas = 5;
      break;
    }
  }


  public function evaluateCart($symbolCurrent){
    $language      = session()->get('locale');
    $productInCart = \Cart::session(Auth()->user()->idUser)->getContent();
    if ( count($productInCart) > 0 ) {
      foreach ($productInCart as $key => $value) {}
        if( $value->attributes->symbolCurrent === $symbolCurrent ) {
          return true;
        }else{
          if ($language == 'en') {
            $this->dispatchBrowserEvent('error', ['msg' => 'You already have an added product with  '.$value->attributes->symbolCurrent.', you cannot add with a product with different currency in the same purchase, finish the purchase active or clean the cart.']);
            return false;
          } else {
            $this->dispatchBrowserEvent('error', ['msg' => 'Ya tiene un producto agregado con '.$value->attributes->symbolCurrent.' como moneda, no puede agregar un product con una moneda diferente en la misma compra, finalize la compra activa o limpie el carrito.']);
            return false;
          }
        }
    }
    return true;
  }

  public function addCart($id, $cant = 1)
  {
    $this->obtenerOnzas($id);
    $cantTem                = \Cart::session(Auth()->user()->idUser)->getContent()->count();
    $descuento              = $this->products[$id]['price'] * 0.15;
    $descuentoNavideño      = $this->products[$id]['price'] * 0.50;
    $price                  = number_format(floatval($this->products[$id]['price'] - $descuento),2);
    $price                  = number_format(floatval($price - $descuentoNavideño),2);
    $symbolCurrent          =   "$"; 
    switch ($this->current) {
        case 'guatemala':
            $price =  floatval(7.8 * $price);
            $symbolCurrent  =   "GTQ"; 
            break;
        case 'colombia':
            $price = floatval(4171.57 * $price);
            $symbolCurrent  =   "COP";
            break;
        case 'mexico':
            $price = floatval(17.28 * $price); 
            $symbolCurrent  =   "MXN";
            break;
        default:
            $price =  floatval($price * 1); 
            $symbolCurrent  =   "$";
            break;
    };

    switch ($this->state) {
      case 'Nevada':
        $this->taxes =number_format(floatval( (8.375 * $price) / 100 ), 2);
        break;
      default:
        $this->taxes = 0;
        break;
    };

    if($this->evaluateCart($symbolCurrent)){
  
      \Cart::session(Auth()->user()->idUser)->add(array(
        'id'            => $this->products[$id]['idProd'], // inique row ID
        'name'          => $this->products[$id]['name'],
        'price'         => $price,
        'quantity'      => $cant,
        'attributes'    => array(
          'img'           => $this->products[$id]['img'],
          'puntos'        => $this->products[$id]['puntos'],
          'onzas'         => number_format(floatval($this->onzas), 2),
          'tax'           => $this->taxes,
          'symbolCurrent' => $symbolCurrent
        ),
      ));

      $this->puntosTemporal     = $this->products[$id]['puntos'];
      $this->cantidadProductos  = \Cart::session(Auth()->user()->idUser)->getContent($id)->count();
      $language                 = session()->get('locale');
      if ($this->cantidadProductos == $cantTem) {
        if ($language == 'en') {
          $this->dispatchBrowserEvent('noty', ['msg' => 'Product Updated']);
        } else {
          $this->dispatchBrowserEvent('noty', ['msg' => 'Producto Actualizado la cantidad']);
        }
        $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->getContent($id)->count();
      } else {
        if ($language == 'en') {
          $this->dispatchBrowserEvent('noty', ['msg' => 'Add new Product!']);
        } else {
          $this->dispatchBrowserEvent('noty', ['msg' => 'Producto nuevo agregado!']);
        }
      }

    }

  }

  public function ClearCart()
  {
    \Cart::session(Auth()->user()->idUser)->clear();
    $this->cantidadProductos  = \Cart::session(Auth()->user()->idUser)->getContent()->count();
    $this->shippingfront      = 0;
    $this->onzasfront         = 0;
  }
}
