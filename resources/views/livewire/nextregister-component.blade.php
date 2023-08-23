<div class="mt-5"  style="margin-top: 60px">
    <div class="container sm:px-10">
        {{-- <div class="block xl:grid grid-cols-2 gap-4"> --}}
        <div class="block xl:grid grid-cols-4 gap-2">

            <!-- BEGIN: Login Info -->
           
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                  <span class="-intro-x text-white text-lg ml-3 ">
                    Selected State: {{$state}}  
                  </span>
                    <img alt="Besanaglobal.com" class="w-6" src="{{ asset('img/LogoWhite.png') }}">
                    <span class="text-white text-lg ml-3">
                        AppBesana
                    </span>
                    <button class="-intro-x ml-3 btn btn-outline-danger" wire:click="logout()">
                        Logout
                   </button>
                </a>
                

                <span class="-intro-x text-white font-bold">Taxes: {{$taxes}}</span>
                <span class="-intro-x text-white font-bold">Envio: {{$shipping}}</span>

                <h2 class="intro-x text-white font-bold text-xl xl:text-xl text-center xl:text-left">TOTAL  + Membresia : </h2> 
                <br>
                  <h2 class="-intro-x text-white font-bold ">$USD {{floatval($total)}}</h2> 
                <table class="intro-x table-auto">
                    <thead class="text-xs  uppercase bg-gray-50">
                      <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>


                      </tr>
                    </thead>
                    <tbody class="bg-yellow-200">
                        @forelse ($items as $i )
                        <tr class="text-center">
                            <td>{{$i->id}}</td>
                            <td>{{$i->name}}</td>
                            <td>{{$i->quantity}}</td>
                            <td>{{$i->price}}</td>

                           
                          </tr>
                        @empty
                        <tr class="text-center">
                            NO DATA
                           
                          </tr>
                        @endforelse
                        <tr>TOTAL :{{$total}}</tr>
                      
                      
                    </tbody>
                  </table>
                 
           
                <div class="my-auto">

                    <img alt="Besana" class="-intro-x w-1/2 -mt-16" src="{{ asset('img/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-xl leading-tight mt-10">to continue with your registration you need to select a package <br> </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">welcome Bessana</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                  @if ($cantidadProductos==0)
                      <a href="#" class="-intro-x btn btn-danger" >
                        <img src="{{asset('img/icon-cart.png')}}" alt="Cart">
                          Cart - No Proudcts
                      </a>
                  @else
                    <a href="{{route('payment')}}" class="-intro-x btn btn-danger" >
                      <img src="{{asset('img/icon-cart.png')}}" alt="Cart">
                        Cart - {{$cantidadProductos}}
                    </a>
                        
                  @endif 
                  
                   <button class="-intro-x btn btn-warning" wire:click="ClearCart()">
                    <img src="{{asset('img/icon-cart.png')}}" alt="Cart">
                    Clear Cart - {{$cantidadProductos}}
               </button>
               <button class="-intro-x btn btn-dark" wire:click="ClearCart()">
                
                Peso - {{$totalOnzas}}
           </button>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">
                        
                        <div class="flex">
                            <div class="max-w-sm w-full lg:max-w-full lg:flex">
                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" >
                                    <img src="{{asset('img/products/paqueteBesana.png')}}" alt="">
                                </div>
                                <div style="width: max-content;" class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                  <div class="mb-8">
                                    <div class="text-red-900 font-bold text-xl mb-2">Besana Beauty Package</div>

                                    <p class="text-sm text-gray-600 flex items-center">
                                      <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                                      </svg>
                                      Price: $189.95 
                                    </p>
                                    <div class="text-gray-900 font-bold text-xl mb-2">TEXT-PENDIENTE</div>
                                    <p class="text-gray-700 text-base">189 puntos.</p>
                                  </div>
                                  <button class="flex items-center mr-3 btn btn-primary" wire:click="addCart(1,189.95,26)">
                                     Add 
                                </button>
                                </div>
                            </div>
                            {{-- paquete #2 --}}
                            <div class="max-w-sm w-full lg:max-w-full lg:flex">
                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" >
                                    <img src="{{asset('img/products/b-max.png')}}" alt="b-max">
                                </div>
                                <div style="width: max-content;"  class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                  <div class="mb-8">
                                    <div class="text-red-900 font-bold text-xl mb-2">B-MAX</div>

                                    <p class="text-sm text-gray-600 flex items-center">
                                      <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                                      </svg>
                                      Price: $69.95 
                                    </p>
                                    <div class="text-gray-900 font-bold text-xl mb-2">TEXTO-PENDIENTE</div>
                                    <p class="text-gray-700 text-base">70 puntos.</p>
                                  </div>
                                  <button class="flex items-center  btn btn-primary" wire:click="addCart(2,69.95,3)">
                                    Add 
                                </button>
                                </div>
                            </div>
                            {{-- paquete #3 --}}
                            <div class="max-w-sm w-full lg:max-w-full lg:flex">
                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" >
                                    <img src="{{asset('img/products/Aceite.png')}}" alt="">
                                </div>
                                <div style="width: max-content;" class="max-w-max border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                  <div class="mb-8">
                                    <div class="text-red-900 font-bold text-xl mb-2">CBG-5</div>

                                    <p class=" bg-red-700 text-sm text-white flex items-center p-1 rounded-lg">
                                      <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                                      </svg>
                                      Price: $99.95
                                    </p>
                                    <div class="text-gray-900 font-bold text-xl mb-2">CBG-5</div>
                                    <p class="text-gray-700 text-base">100 puntos.</p>
                                  </div>
                                  <button class="flex items-center mr-3 btn btn-primary" wire:click="addCart(3,99.95,3)">
                                     Add 
                                </button>
                                </div>
                            </div>
                            {{-- membresia --}}
                 

                        </div>
                    </div>
                    <div class="max-w-sm w-full lg:max-w-full lg:flex">
                      <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" >
                          <img class="-intro-x" src="{{asset('img/products/Aceite.png')}}" alt="">
                      </div>
                      <div style="width: max-content;" class="max-w-max border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                          <div class="text-red-900 font-bold text-xl mb-2">MEMBRESIA SOCIO-PROMOTOR</div>

                          <p class=" bg-red-700 text-sm text-white flex items-center p-1 rounded-lg">
                            <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                              <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                            </svg>
                            Price: $24.95
                          </p>
                          <div class="text-gray-900 font-bold text-xl mb-2">MEMBRESIA SOCIO-PROMOTOR</div>
                          <p class="text-gray-700 text-base">0 puntos.</p>
                        </div>
                        <button class="flex items-center mr-3 btn btn-primary" wire:click="addCart(3,24.95,0)">
                           Add 
                      </button>
                      </div>
                  </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</div>
