<div class="container mx-auto">

    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/3 px-4">
            <div class="">
                <h1 class="font-bold uppercase text-xl p-2 bg-gray-600 rounded mb-3 text-white text-center">{{__('Information')}}</h1>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Name')}}</span>
                <input readonly id="name" value="{{$b->Name}}" type="text" class="form-control" placeholder="{{$b->Name}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Last Name')}}</span>
                <input readonly value="{{$b->LastName}}" type="text" class="form-control" placeholder="{{$b->LastName}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Email')}}</span>
                <input id="email" value="{{$b->Email}}" readonly type="text" class="form-control" placeholder="{{$b->Email}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">{{__('Phone')}}</span>
                <input readonly type="text" id="phone" class="form-control" value="{{$b->Phone}}" placeholder="{{$b->Phone}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text pr-2" id="basic-addon1">{{__('ZipCode')}}</span>
                <input readonly type="text" id="zipcode" class="form-control" value="{{$b->ZipCode}}" placeholder="{{$b->ZipCode}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text pr-2">{{__('Address')}}</span>
                <input  readonly id="address" value="{{$b->Address}}" type="text" class="form-control" placeholder="{{$b->Address}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text pr-2" id="basic-addon1">{{__('Country')}}</span>
                <input readonly id="country" value="{{$b->Country}}" type="text" class="form-control" placeholder="" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text pr-2" id="basic-addon1">{{__('State')}}</span>
                <input  readonly id="state" type="text" class="form-control" placeholder="{{$b->State}}" value="{{$b->State}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text pr-2" id="basic-addon1">{{__('City')}}</span>
                <input readonly type="text" id="city" class="form-control" value="{{$b->City}}" placeholder="{{$b->City}}" aria-label="notification" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="w-full md:w-1/3 px-4">
            <h1 class="font-bold uppercase text-xl p-2 bg-gray-600 rounded mb-3 text-white text-center">{{__('Purchase Detail')}}</h1>
            <h2>Onzas Total: {{$onzasblade}}</h2>
            <h2>tax estado: {{$taxes}}</h2>
            <table class="table-responsive text-center w-full">
                <thead>
                    <tr>
                        <th class="p-2 bg-primary text-white">{{__('Amount')}}</th>
                        <th class="p-2 bg-primary text-white">{{__('Product')}}</th>
                        <th class="p-2 bg-primary text-white">{{{__('Price')}}}</th>
                        <th class="p-2 bg-primary text-white">{{__('Tax')}}</th>
                        <th class="p-2 bg-primary text-white">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                  
                    @forelse($cantidadProductos as $pro)
                        @php
                            $taxunique=number_format(floatval(($pro->price*$this->taxes)/100),2);
                            $taxblade=$taxunique*$pro->quantity;
                            $taxtotal+=$taxblade;
                        @endphp
                    @if ($pro->attributes->membresia > 0)
                    <tr class="border-4  border-b-gray-500">
                        <td class="text-center">
                            <span class="badge badge-info">{{1}}</span>
                            <input type="hidden" id="member" name="member" value="1">
                        </td>
                        <td class=" pr-5"> <span class="">Membresia </span></td>
                        <td class=" text-right">$ 24.95</td>
                        <td class=" text-right ">$ 0</td>
                        <td class="text-right">{{number_format(floatval(24.95),2)}}</td>
                    </tr>
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
                        <td class=" text-right">$ {{ number_format(floatval($pro->price),2) }}</td>
                        <td class=" text-right ">$ {{$taxunique}}</td>
                        <td class="text-right">{{number_format(floatval(($pro->price+$taxunique)*$pro->quantity),2)}}</td>
                    </tr>
                    @empty
                    <tr class="border-4 border-indigo-200 border-b-indigo-500">
                        <td colspan="6">NO DATA</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td></td>
                        <td class="text-center ">Subtotal:</td>
                        <td></td>
                        <td>
                            <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold "> {{number_format(floatval($subtotalweb),2)}}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center ">
                            {{__('Shipping')}}:
                        </td>
                        <td></td>
                        <td>
                            <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold "> {{number_format(floatval($shipping),2)}}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center ">
                            TOTAL: $.
                        </td>
                        <td></td>
                        <td>
                            <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold "> {{number_format(floatval($totalImpuestoShipping),2)}}</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-full md:w-1/3 px-4">
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
                    <button id="card-button" type="submit" class="btn btn-primary mt-3"> {{__('Pay')}} </button>
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

    const city = "{{$b->City}}"
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
    // var stt=  stripe.updatePaymentIntent(paymentIntentId,{
    //         'amount_details':amount_details
    //     });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        let nameCard = document.getElementById('nameCard').value
        const name = document.getElementById('name').value;
        let package = document.getElementById('package').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        const totalfull = document.getElementById('totalfull').value;
        cardButton.disabled = true;

        stripe.createToken(cardElement, {
            name: nameCard
        }).then(function(result) {
            if (result.error) {
                Livewire.emit('stripeError', result.error.message)
                // console.log(result.error.message)
            } else {
                // Enviar el token a tu servidor
                var input = document.createElement('input');
                if (document.getElementById('member') !== null) {
                    let member = document.getElementById('member').value;
                    Livewire.emit('pay', result.token.id, name, totalfull, member ,package)                    
                }else{
                    Livewire.emit('pay', result.token.id, name, totalfull, 0, package)

                }
                //  form.submit();
                // console.log(result.token.id)
            }
            cardButton.disabled = false;
        });
    });
</script>
@endpush