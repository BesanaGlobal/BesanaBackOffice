<div class="container mx-auto">
    <div class="flex flex-wrap -mx-4 mt-5">
        @if($viewStatus !== 1)
            <div class="w-full pb-4 flex justify-end">
                <button class="btn btn-outline-primary btn-lg mr-4" id="comeBack" name="comeBack" onclick="comeBack()">Seguir Comprando</button>
                <button class="btn btn-outline-danger btn-lg mr-3" id="cleanCart" name="cleanCart" onclick="cleaning()">Limpiar Carrito</button>
            </div>
        @endif
        <div class="w-full md:w-1/3 px-4">
            <div class="">
                <h1 class="font-bold uppercase text-xl p-2 bg-gray-600 rounded mb-3 text-white text-center">{{__('Information')}}</h1>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Names')}}</span>
                <input readonly id="name" value="{{$b->Name}}" type="text" class="form-control" placeholder="{{$b->Name}}">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('LastName')}}</span>
                <input readonly value="{{$b->LastName}}" type="text" class="form-control" placeholder="{{$b->LastName}}">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Email')}}</span>
                <input id="email" value="{{$b->Email}}" readonly type="text" class="form-control" placeholder="{{$b->Email}}">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Phone')}}</span>
                <input readonly type="text" id="phone" class="form-control" value="{{$b->AlternativePhone}}" placeholder="{{$b->AlternativePhone}}">
            </div>
            <div class="input-group mb-3">
                <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="optionAddress" id="address1" wire:model="selectedOption" value="option1" checked>
                    <label class="form-check-label" for="address1">
                        Dirección principal
                    </label>
                </div>
                <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="optionAddress" id="address2" wire:model="selectedOption" value="option2">
                    <label class="form-check-label" for="address2">
                        Otra dirección
                    </label>
                </div>
            </div>

            @if($selectedOption === "option1")
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('Country')}}</span>
                    <input readonly id="country" value="{{$b->Country}}" type="text" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('State')}}</span>
                    <input  readonly id="state" type="text" class="form-control" value="{{$b->State}}">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('City')}}</span>
                    <input readonly type="text" id="city" class="form-control" value="{{$b->City}}">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2">{{__('Address')}}</span>
                    <input  readonly id="address" value="{{$b->Address}}" type="text" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('ZipCode')}}</span>
                    <input readonly type="text" id="zipcode" class="form-control" value="{{$b->ZipCode}}">
                </div>
            @else
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('Country')}}</span>
                    <select wire:model="selectedCountry" id="Country" class="form-control">
                        <option  selected disabled>Selecciona un País</option>
                        <option ></option>
                        @foreach($Countries as $country => $value)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('State')}}</span>
                    <select wire:model="selectedState" id="State" class="form-control">
                        <option selected disabled>Selecciona un Estado</option>
                        <option></option>
                        @if (!is_null($States))
                            @foreach($States as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('City')}}</span>
                    <input type="text" id="selectedCit" name="selectedCity" class="form-control" wire:model="selectedCity" value="">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2">{{__('Address')}}</span>
                    <input id="alternativeAddres" name="alternativeAddress" type="text" wire:model="alternativeAddress" class="form-control" value="">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text pr-2" id="basic-addon1">{{__('ZipCode')}}</span>
                    <input type="number" id="zipCode" class="form-control" wire:model="zipCode" value="" >
                </div>      
            @endif
        </div>

        <div class="w-2/3 md:w-3/5  px-4">
            <div>
                <h1 class="font-bold uppercase text-xl p-2 bg-gray-600 rounded mb-3 text-white text-center">{{__('Purchase Detail')}}</h1>
            </div>
            <h2>Onzas Total: {{$onzasblade}}</h2>
            <h2>tax estado: {{$taxes}}</h2>
            <div class="table-responsive">
                <table class="table sm:table-auto text-center">
                    <thead>
                        <tr>
                            <th class="p-2 bg-primary text-white text-center">{{__('Amount')}}</th>
                            <th class="p-2 bg-primary text-white text-center">{{__('Product')}}</th>
                            <th class="p-2 bg-primary text-white text-center">{{{__('Price')}}}</th>
                            <th class="p-2 bg-primary text-white text-center">{{__('Tax')}}</th>
                            <th class="p-2 bg-primary text-white text-center">Subtotal</th>
                            <th class="p-2 bg-primary text-white text-center">Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pointsTotal = 0;
                        @endphp
                        @forelse($cantidadProductos as $pro)
                            @php
                                if($pro->name === "MEMBERSHIP"){
                                    $taxunique   =   0;
                                }else{
                                    $taxunique      =   ($pro->price *   $this->taxes)/100;
                                }
                                $taxblade       =   $taxunique  *   $pro->quantity;
                                $taxtotal       +=  $taxblade;
                                $pointsTotal    += $pro->attributes->puntos * $pro->quantity;
                            @endphp
                        @if ($pro->attributes->membresia > 0)
                            @php
                                $symbolCurrent    =   $pro->attributes->symbolCurrent; 
                                switch ($symbolCurrent) {
                                    case 'GTQ':
                                        $costMembership     = number_format(floatval(7.8 * 24.95),2); 
                                        break;
                                    case 'COP':
                                        $costMembership     = number_format(floatval(4171.57 * 24.95),2);
                                        break;
                                    case 'MXN':
                                        $costMembership     = number_format(floatval(17.28 * 24.95),2);
                                        break;
                                    default:
                                        $costMembership     = 24.95 * 1;
                                        break;
                                } 
                            @endphp
                            @if($pro->name !== "MEMBERSHIP")
                                <tr class="border-4  border-b-gray-500">
                                    <td class="text-center">
                                        <span class="badge badge-info">{{1}}</span>
                                        <input type="hidden" id="member" name="member" value="1">
                                    </td>
                                    <td class=" pr-5"> <span class="">Membresía</span></td>
                                    <td class=" text-right">{{$pro->attributes->symbolCurrent}} {{$costMembership}}</td>
                                    <td class=" text-right ">{{$pro->attributes->symbolCurrent}} 0.00</td>
                                    <td class="text-right">{{$pro->attributes->symbolCurrent}} {{$costMembership}}</td>
                                </tr>
                            @endif
                        @endif
                        <tr class="border-4  border-b-gray-500">
                            <td class="text-center">
                                <button class="btn btn-primary" wire:click="incrementQuantity({{$pro->id}})">+</button>
                                <span class="badge badge-info ml-4 mr-4">{{$pro->quantity}}</span>
                                <button class="btn btn-primary" wire:click="decrementQuantity({{$pro->id}})">-</button>
                            </td>
                            <td class=" pr-5"> 
                                <span class=""> {{$pro->name}}</span>
                                <input type="hidden" id="package" name="package" value="{{$pro->name}}">
                            </td>
                            <td class=" text-right">{{$pro->attributes->symbolCurrent}} {{ number_format(floatval($pro->price),2) }}</td>
                            <td class=" text-right">{{$pro->attributes->symbolCurrent}} {{number_format(floatval($taxunique),2)}}</td>
                            <td class="text-right">{{$pro->attributes->symbolCurrent}} {{number_format(floatval(($pro->price + $taxunique) * $pro->quantity),2)}}</td>
                            <td class="text-right">Pts. {{number_format($pro->attributes->puntos * $pro->quantity)}}</td>
                        </tr>
                        @empty
                        <tr class="border-4 border-indigo-200 border-b-indigo-500">
                            <td colspan="6">NO DATA</td>
                        </tr>
                        @endforelse

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center ">Subtotal:</td>
                            <td></td>
                            <td>
                                <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold text-center">{{$pro->attributes->symbolCurrent}} {{number_format(floatval($subtotalweb),2)}}</h1>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center ">{{__('Shipping')}}:</td>
                            <td></td>
                            <td>
                                <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold text-center">{{$pro->attributes->symbolCurrent}} {{number_format(floatval($shipping),2)}}</h1>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center ">Total:</td>
                            <td></td>
                            <td>
                                <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold text-center">{{$pro->attributes->symbolCurrent}}  {{number_format(floatval($totalImpuestoShipping),2)}}</h1>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center ">Puntos a obtener:</td>
                            <td></td>
                            <td>
                                <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold text-center">Pts. {{number_format($pointsTotal)}}</h1>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="w-1/3 md:w-1/3  px-4">
            <div class="">
                <h1 class="font-bold uppercase text-xl p-2 bg-gray-600 rounded mb-3 text-white text-center">{{__('Payment method')}}</h1>
            </div>
            <div class="input-group mb-3">
                <h1 class="fw-bold text-dark">Accepted Cards:</h1>
                <img src="{{asset('img/creditcard.png')}}" class="object-fill h-10 w-66" alt="">
            </div>
            <div class="input-group mb-3">
            </div>
            <form id="payment-form">
                @csrf
                <label class="font-black uppercase text-base" for="">Total:</label>
                <input readonly id="totalfull" type="text" value="{{number_format(floatval($totalImpuestoShipping),2)}}" class="-intro-y form-control">
                <label class="font-black uppercase text-base" for="">Puntos Totales:</label>
                <input readonly id="totalPoints" type="text" value="{{number_format($pointsTotal)}}" class="-intro-y form-control">
                <label class="font-black uppercase text-base" for="nameCard">{{__('Name')}}:</label>
                <input type="text" id="nameCard" class="-intro-x form-control" placeholder="Nombre del Titular">
                <label class="font-black uppercase text-base" for="nameCard">{{__('Card Data')}}:</label>
                <div id="card-element">
                </div>
                <div id="payment-element" class="bg-stone-50 p-3" wire:ignore>
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
                <div class="card-footer">
                    <button id="card-button" type="submit" class="btn btn-primary btn-lg mt-3"> {{__('Pay')}} </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('javascript')
<script>
    window.addEventListener('package', event => {
        Swal.fire('', event.detail.msg).then(result => {
                        if (result.isConfirmed) {
                            Livewire.emit('success')
                            window.location = '/login'
                        }
                    }

                )
        
    })

    window.addEventListener('noticia', event => {
        Swal.fire('', event.detail.msg).then(result => {
                        if (result.isConfirmed) {
                            Livewire.emit('success')
                            window.location = '/products'
                        }
                    }

                )
        
    })

    
    window.addEventListener('noticiaError', event => {
        Swal.fire('', event.detail.msg)
    })

    const city = "{{$b->City}}";
    const keystripe = "{{ $STRIPE_KEY }} ";
    const stripe = Stripe(keystripe);
    const elements = stripe.elements();
   
    const cardElement = elements.create('card', {
        style: {
            base: {
                color: "#32325d",
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#32325d"
                }
            },
            invalid: {
                iconColor: 'red',
                color: 'white',
            },
        },
    });

    cardElement.mount('#payment-element');
    cardElement.addEventListener('change', function(event) {
        event.preventDefault();
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    const cardButton = document.getElementById('card-button');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        let nameCard        = document.getElementById('nameCard').value
        const name          = document.getElementById('name').value;
        let package         = document.getElementById('package').value;
        const email         = document.getElementById('email').value;
        const totalfull     = document.getElementById('totalfull').value;
        const totalPoints   = document.getElementById('totalPoints').value;
        cardButton.disabled = true;

        stripe.createToken(cardElement, {
            name: nameCard
        }).then(function(result) {
            if (result.error) {
                Livewire.emit('stripeError', result.error.message)
            } else {
                var input = document.createElement('input');
                if (document.getElementById('member') !== null) {
                    let member = document.getElementById('member').value;
                    Livewire.emit('pay', result.token.id, name, totalfull,totalPoints, member ,package)                    
                }else{
                    Livewire.emit('pay', result.token.id, name, totalfull,totalPoints, 0, package)

                }
            }
            cardButton.disabled = false;
        });
    });

    function cleaning() {
        Swal.fire({
            title: 'Info',
            text: "¿CONFIRM CLEAR?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.Cleaning()
            }
        })
    }

    function comeBack(){
        window.location = '/products';
    }


</script>
@endpush