<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NextregisterComponent extends Component
{
  public $items = [];
  public $totalOnzas;
  public $total = 0;
  public array $datas = [];
  public $membresia = false;
  public $taxes = 0;
  public $shipping = 0;
  public $state;
  public $cantidadProductos = 0;

  public $current;

  protected $listeners = [
    'addCart' => 'addCart',
    'changeCurrent' => 'changeCurrent',
  ];

  public function changeCurrent($value)
  {
    $this->current = $value;
  }


  public function render()
  {
    $af                       = User::where('idUser', Auth()->user()->idUser)->first();
    $Affiliated               = Affiliate::where('idAffiliated', $af->idAffiliated)->first();
    $this->state              = strtoupper($Affiliated->State);
    $this->cantidadProductos  = \Cart::session(Auth()->user()->idUser)->getContent()->count();
    $this->items              = \Cart::session(Auth()->user()->idUser)->getContent();
    $this->total              = \Cart::session(Auth()->user()->idUser)->getTotal();

    return view('livewire.nextregister-component2')->extends('layout.base')->section('body');
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

  public function addCart($id,$package,$symbolCurrent,$price,$onzas,$quantity,$points)
  {

    $this->onzasPrice($onzas);
    $taxState   = 0;
    $newprice   = 0;
    $membership = 0;

    switch ($symbolCurrent) {
      case 'GTQ':
        $membership     = number_format(floatval(7.8 * 24.95),2);
        break;
      case 'COP':
        $membership     = number_format(floatval(4171.57 * 24.95),2);
        break;
      case 'MXN':
        $membership     = number_format(floatval(17.28 * 24.95),2);
        break;
      default:
        $membership     = 24.95 * 1;
        break;
    } 

    switch ($this->state){
      case 'Nevada':
        $taxState     = 8.375;
        break;
      default:
        $taxState     = 0;
        break;
    }
    
    switch($id){
      case 1 :
        $price    = floatval(str_replace(',', '', $price));
        $priceTax = $price;
        $newprice = $price - $membership;
        \Cart::session(Auth()->user()->idUser)->add(array(
          'id' => $id, // inique row ID
          'name' => $package,
          'price' => $newprice,
          'attributes' => array(
            'producto' => $newprice,
            'tax' => 0,
            'shipping' => 0,
            'membresia' => $membership,
            'puntos' => 0,
            'onzas' => 0,
            'symbolCurrent' => $symbolCurrent
          ),
          'quantity' => 1,
        ));
        break;
      case 2 :
        $price    = floatval(str_replace(',', '', $price));
        $newprice = $price - $membership;
        \Cart::session(Auth()->user()->idUser)->add(array(
          'id' => $id, // inique row ID
          'name' => $package,
          'price' => $newprice,
          'attributes' => array(
            'producto' => $newprice,
            'tax' => $this->taxes,
            'shipping' => $this->shipping,
            'membresia' => $membership,
            'puntos' => $points,
            'onzas' => 1.8,
            'symbolCurrent' => $symbolCurrent
          ),
          'quantity' => 1,
        )); 
        break;
      case 3 :
        $price    = floatval(str_replace(',', '', $price));
        $newprice = $price - $membership;
        \Cart::session(Auth()->user()->idUser)->add(array(
          'id' => $id, // inique row ID
          'name' => $package,
          'price' => $newprice,
          'attributes' => array(
            'producto' => $newprice,
            'tax' => $this->taxes,
            'shipping' => $this->shipping,
            'membresia' => $membership,
            'puntos' => $points,
            'onzas' => 3,
            'symbolCurrent' => $symbolCurrent
          ),
          'quantity' => 1,
        ));      
        break;
      case 4 :
        $price    = floatval(str_replace(',', '', $price));
        $newprice = $price - $membership;
        \Cart::session(Auth()->user()->idUser)->add(array(
          'id' => $id, // inique row ID
          'name' => $package,
          'price' => $newprice,
          'attributes' => array(
            'producto' => $newprice,
            'tax' => $this->taxes,
            'shipping' => $this->shipping,
            'membresia' => $membership,
            'puntos' => $points,
            'onzas' => 3,
            'symbolCurrent' => $symbolCurrent
          ),
          'quantity' => 1,
        ));
        break;
      case 5 :
        $price    = floatval(str_replace(',', '', $price));
        $newprice = $price - $membership;
        \Cart::session(Auth()->user()->idUser)->add(array(
          'id' => $id, // inique row ID
          'name' => $package,
          'price' => $newprice,
          'attributes' => array(
            'producto' => $newprice,
            'tax' => $this->taxes,
            'shipping' => $this->shipping,
            'membresia' => $membership,
            'puntos' => $points,
            'onzas' => 10,
            'symbolCurrent' => $symbolCurrent
          ),
          'quantity' => 1,
        ));  
        break;
    }
    return redirect()->route('cart-pay');
  }

  public function Cart($id, $price, $onzas)
  {
    $this->onzasPrice($onzas);
    $taxState = 0;
    switch ($this->state) {
      case 'Nevada':
        $taxState = 8.375;
        break;
      case 'California':
        $taxState = 6.5;
        break;
      case 'Utah':
        $taxState = 4.7;
        break;
      case 'Other':
        $taxState = 0;
        break;
    }

    $existMem = \Cart::session(Auth()->user()->idUser)->getContent(0)->count();

    if ($price == 24.95) {

      if ($existMem > 0) {
        return;
      }

      $priceTax = $price;
      \Cart::session(Auth()->user()->idUser)->add(array(
        'id' => 0, // inique row ID
        'name' => 'Membresia',
        'price' => 24.95,
        'quantity' => 1,
      ));
      $this->membresia = true;
      
      return;
    }
    $this->taxes = round($price * $taxState / 100, 2);
    $priceTax    = round($this->taxes + $price, 2);

    if ($this->membresia == false) {
      \Cart::session(Auth()->user()->idUser)->add(array(
        'id' => 0, // inique row ID
        'name' => 'Membresia',
        'price' => 24.95,
        'quantity' => 1,
      ));
      $this->membresia = true;
    }

    $cantTem = \Cart::session(Auth()->user()->idUser)->getContent()->count();

    \Cart::session(Auth()->user()->idUser)->add(array(
      'id' => $id, // inique row ID
      'name' => 'Package #' . $id . 'Tax: ' . $this->taxes,
      'price' => $priceTax,
      'quantity' => 1,
    ));

    $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->getContent($id)->count();

    if ($this->cantidadProductos == $cantTem) {
      $this->dispatchBrowserEvent('noty', ['msg' => 'Producto Actualizado la cantidad']);
      $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->getContent($id)->count();
    } else {
      $this->dispatchBrowserEvent('noty', ['msg' => 'Producto nuevo agregado!']);
    }
  }

  public function ClearCart()
  {
    \Cart::session(Auth()->user()->idUser)->clear();
    $this->cantidadProductos = \Cart::getContent()->count();
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
