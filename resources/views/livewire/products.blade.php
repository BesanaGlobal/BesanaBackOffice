<div>
    @if ($total>0)
        <div class="shadow shadow-green-600 shadow-2xl fixed flex  " 
        style="margin-top: 30px;
        z-index: 500;
        top: 5px;
        margin-right: 500px;
        right: 0;"
                        > 
                        <div class="flex">
                            <a href="{{route('cart-pay',$onzasfront,)}}" class="btn btn-primary flex  " 
                        
                            >
                            <i class="fa-solid fa-cart-shopping fs-4 mr-2 bg-white"></i>
                            <span class="flex  "  >
                            {{$total}}
                            <img class="color-white-300 text-white bg-white ml-2" src="{{asset('img/cart.svg')}}" alt="" width="20px">

                            </span>
                            </a>
                        </div>
                           
                            <button onclick="limpiar()""  class="btn btn-outline-danger ml-2"  >{{__('Clear')}}</button>

        </div>
    @endif

   
    @if(session('success'))
    <div class="bg-green-400 p-4 rounded-b-lg ">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-400 p-4 rounded-b-lg text-white">{{ session('error') }}</div>
    @endif
    <div class="grid grid-cols-3 gap-4 mt-5">
       
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
           
            
       


            <span class="intro-x text-primary">
         
            </span>
           
            
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                
            </div>
        </div>
    </div>
        <!-- BEGIN: Users Layout -->
        <div class="intro-y grid gap-2 grid-cols-1 sm:grid-cols-3 md:gap-4 mt-3">
        @forelse ($products as $key => $pro)
            
                <div class="col-span-1 box shadow rounded rounded-lg border-double border-4 border-gray-400
                    @if ($pro->idLine==3)
                        shadow-belleza
                    @else
                        shadow-salud
                    @endif
                    shadow-xl">
                    
                        <div class="   rounded-md overflow-hidden " >
                            <img alt="{{$pro->name}}" class="object-contain h-48 w-96" src="{{ asset('img/products/'.$pro->img) }}" />
                        </div>
                        
                
                        <div class="text-slate-600 rounded rounded-lg dark:text-slate-500 mt-1
                            @if ($pro->idLine==3)
                                bg-belleza
                            @else
                                bg-salud
                            @endif
                        ">
                            <div class="flex flex-col items-center  p-2 text-dark">
                                <h1 class="block font-medium text-base">{{$pro->name}}</h1>
                                @php
                                    $descuento = $pro->price*0.15;
                                    $price=number_format(floatval($pro->price - $descuento),2);
                                @endphp
                                 {{__('Price')}}: ${{ $price }}
                                 <span class="font-black">{{__('Points to Receive')}}:</span>
                                 <span class="font-black ">{{$pro->puntos}} {{__('Points')}}</span>
                                 <button class="btn btn-primary btn-sm " wire:click="addCart({{$key}})">
                                     {{__('Add cart')}}
                                </button>

                            </div>
                           
                        </div>
                </div> 
            @empty
            <div>
                <span colspan="6">
                    NO DATA
                </span>
            </div>
        @endforelse
    </div>
</div>
<script>
    function fireModal(action = 1) {

        if (action == 1) {
            document.querySelector('.modal').classList.add('show')
            document.querySelector('.modal').style.display = 'block'
        } else {
            document.querySelector('.modal').classList.add('hide')
            document.querySelector('.modal').style.display = 'none'
        }
    }



    window.addEventListener('modal-open', event => {
        fireModal(1)
    })

    window.addEventListener('noty', event => {
        Swal.fire('', event.detail.msg)
        if (event.detail.action == 'close-modal') fireModal(0)
    })


    
    function limpiar() {
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
                /// Swal.fire('Deleted!', 'Your file has been deleted.', 'success')
                //window.livewire.emit('Destroy', CustomerId) // 1,2 ,3
                @this.ClearCart()
            }
        })
    }
    
</script>
