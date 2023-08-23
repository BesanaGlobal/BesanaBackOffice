
<div>
    
       
    <div class="flex flex-row bg-white p-2">    
                     
                        <div class="basis-1/4 p-3">
                           
                                    <div class="input-group mb-3">
                                    
                                    <h1 class="fw-bold text-dark">BILLING ADDRESS</h1>
                                       
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <span  class="input-group-text" id="basic-addon1">Name</span>
                                        <input id="name" value="{{$b->Name}}" type="text" class="form-control" placeholder="{{$b->Name}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                  
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Last name</span>
                                        <input readonly value="{{$b->LastName}}" type="text" class="form-control" placeholder="{{$b->LastName}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Email</span>
                                        <input id="email" value="{{$b->Email}}" readonly type="text" class="form-control" placeholder="{{$b->Email}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Phone</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->Phone}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">ZipCode</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->ZipCode}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" >Address</span>
                                        <input id="address" value="{{$b->Address}}" readonly type="text" class="form-control" placeholder="{{$b->Address}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">Country</span>
                                        <input id="country" value="{{$b->Country}}" readonly type="text" class="form-control" placeholder="" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">State</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->State}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text pr-2" id="basic-addon1">City</span>
                                        <input readonly type="text" class="form-control" placeholder="{{$b->City}}" aria-label="notification" aria-describedby="basic-addon1">
                                    </div>
                        </div> 
                        {{-- fin de la primera columna --}}
                        <div class="basis-2/4 py-2">
                                    <div class="input-group mb-3">
                                        <h1 class="fw-bold text-dark">PAYMENT</h1>     
                                    </div>
                                    <div class="input-group mb-3">
                                        <h1 class="fw-bold text-dark">Accepted Cards:</h1>     
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                       <span class="badge badge-success">TOTAL:</span> <h2 class="badge badge-success">{{$total}}</h2>
                                     </div>
                                    
                                    
                                      
                                          <form id="payment-form" method="POST" 
                                          {{-- wire:submit.prevent="save" --}}
                                          >
                                          <input type="text" id="nameCard" class="-intro-x form-control" placeholder="Nombre del Titular">
                                              @csrf
                                            <div id="card-element" >

                                            </div>
                                            <div id="payment-element" >

                                            </div>
                                            
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                            
                                        
                                    
                                    <div class="card-footer">                        
                                      <button
                                      id="card-button"
                                      type="submit"
                                      class="btn btn-primary mt-3"
                                    >  Pagar      </button>
                                
                                    </div>
                                </form>
                        </div>                           
                         
                        
                        <div class="basis-1/4 py-2">
                            
                                <h1>Cantidad de Productos</h1>
                                <span class="badge badge-success">{{$cantidadProductos->count()}}</span>
                                

                                <table class="table-responsive">
                                    <thead>
                                        <tr>                                        
                                            <th class="p-2 bg-primary text-white">PRODUCT</th>      
                                            <th class="p-2 bg-primary text-white">PRICE</th>
                                            <th class="p-2 bg-primary text-white">QUANTITY</th>
                                            <th class="p-2 bg-primary text-white">TOTAL</th>                                         
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        @forelse($cantidadProductos as $pro)
                                        @php
                                            $name=$pro->name;
                                            $precio=$pro->price - $pro->attributes->shipping - $pro->attributes->tax -24.95
                                        @endphp
                                <span>{{ $pro->attributes->shipping}}</span>

                                        <tr>
                                            <td class=" pr-5">
                                                {{-- <img src="{{asset('img/products/'.$pro->attributes['img'])}}" class="card-img-top img-thumbnail mt-3" alt="{{$pro->name}}" style="width: 40px; height:40px;">    --}}
                                                <span class=""> {{$pro->name}}</span>
                                                {{-- <button wire:click="remove({{$pro->id}})" class="btn btn-sm btn-outline-warning m-2">Eliminar</button> --}}
                                            </td>
                                            <td class=" d-flex ">$ {{ number_format(floatval($precio),2) }}</td>
                                            <td class="text-center">
                                                        <span class="badge badge-info">{{$pro->quantity}}</span>                                   
                                            </td>
                                            <td class="text-right">
                                                 {{number_format(floatval($precio),2)}}
                                            </td>                                           
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Membresia:</td>

                                            <td class="text-right">
                                                {{number_format(floatval($pro->attributes->membresia),2)}}
                                            </td>
                                            
                                        </tr> 
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Tax:</td>

                                            <td class="text-right">
                                                
                                                {{number_format(floatval($pro->attributes->tax),2)}}
                                            </td>
                                            
                                        </tr> 
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Shipping:</td>

                                            <td class="text-right">
                                                {{number_format(floatval($pro->attributes->shipping),2)}}
                                               
                                            </td>
                                            
                                        </tr> 

                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                NO DATA
                                            </td>
                                        </tr>
                                        @endforelse    
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="mt-5"> </td>
                                            <td>  <h1 class="mt-5 bg-primary rounded rounded-lg p-2 text-white font-bold text-xl">TOTAL: $. {{number_format(floatval($total),2)}}</h1></td>
                                        </tr>      
                                    </tbody>
                                </table>
                           
                        </div>                                                                                   
                </div>     
</div>
</div>
@push('javascript')
    

<script>

    const city="{{$b->City}}"
    const keystripe="{{ $STRIPE_KEY }} ";

  const nombreproducto="{{$name}}"
//   console.log(nombreproducto)
    const idIntent="{{$idIntente}}"
         
    const clientsecret="{{$intent}}";
    // console.log(idIntent)

    var stripe= Stripe(keystripe);


const paymentIntentId = "{{$idIntente}}";
const amount = 1000; // in cents, so this is equivalent to $10
const amount_details = {
  "subtotal": 500,
  "tax": 250,
  "shipping": 250
};



    
        const options= {
            clientSecret:clientsecret,
        }
    
       
     
        var elements = stripe.elements(options);
    
        const cardElement = elements.create("card",{
      style: {
        base: {
                color: 'dark',
                backgroundColor:'white',
                lineHeight: '48px',
                padding:'12px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '20px',
                '::placeholder': {
                    color: 'gray'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            },
      },
    });
        cardElement.mount('#payment-element');
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    
        // const payElement = elements.create('card');
        // payElement.mount('#card-element');
        
        var form = document.getElementById('payment-form');
        const cardButton = document.getElementById('card-button');
        // var stt=  stripe.updatePaymentIntent(paymentIntentId,{
        //         'amount_details':amount_details
        //     });
            console.log(stripe.updatePaymentIntent);

        form.addEventListener('submit', async(event)=> {

            event.preventDefault();
            
            cardButton.disabled = true;
           
          let nameCard=  document.getElementById('nameCard').value
          const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        // console.log(email);
       await stripe.confirmCardPayment(clientsecret,  {
                payment_method: {
                    card:cardElement,
                    billing_details: { 
                        "address": {
                        "city": '{{$b->City}}',
                        "country": 'US',
                        "line1": '{{$b->Address}}',
                        "line2": null,
                        "postal_code": "{{$b->ZipCode}}",
                        "state": '{{$b->State}}'
                        },
                    }
                    
                }
            })
            .then(function(result) {
                
                // console.log(result)
                const nameP=nombreproducto.toUpperCase();
                if (nameP=='MEMBRESIA') {
                    console.log('ingreso a membresia')
                    result.paymentIntent.amount_details ={
                    nameP:24.95,
                    }
                }else{
                    result.paymentIntent.amount_details ={
                        
                       'producto':'{{ number_format(floatval($precio),2) }}',
                    'Membresia: ':'{{number_format(floatval($pro->attributes->membresia),2)}}',
                    'Tax: ':'{{number_format(floatval($pro->attributes->shipping),2)}}', 
                    'Shipping':'{{number_format(floatval($pro->attributes->shipping),2)}}'
                    }
                }
                
                // console.log(result.paymentIntent)
               if (result.error) {
                cardButton.disabled = false;
                
                     var errorElement = document.getElementById('card-errors');
                     errorElement.textContent = result.error.message;
    
                    //   alert('there is an error paiement') ;
                    Swal.fire('', errorElement.textContent)
    
                  } else {
                 if (result.paymentIntent.status === 'succeeded') {
                    
                    // Swal.fire('success', 'Pago efectuado!!')
                   
                    // Livewire.emit('crearcliente') ;
    
        
                    }
                     else if (result.paymentIntent.status === 'requires_payment_method') {
          
                      
                        
                         alert('there is an error paiement') ;
                  }
                  }
                
            });
           
            });
        
    </script>
@endpush
