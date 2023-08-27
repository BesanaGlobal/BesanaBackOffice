<div>
   
    
    <div class="container">
        <!-- BEGIN: Login Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
            <div class="col-1 p-2">
                <form  wire:submit.prevent="create" >
                    @if (session()->has('mensaje'))
                            <div class=" w-full  alert alert-success">
                                {{ session('mensaje') }}
                            </div>
                    @endif
                    @if (session()->has('error'))
                    <div class=" w-full  alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                            <span class=" font-bold uppercase text-lg ">
                                    {{__('personal information')}}:
                            </span>
                            <div class="w-full">                         
                                <div class="text-xl gap-2 items-center w-full ">
                                    <input  id="Name"
                                        placeholder="{{__('Enter your name')}}"
                                        class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')"
                                        required autofocus />
                                </div>
                            </div>
                            <div class="mt-4 w-full ">
                                <div class="flex text-xl gap-2 items-center">
                                    <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block" type="text"
                                    wire:model="LastName" :value="old('LastName')" required 
                                    placeholder="{{__('Enter your lastname')}}"
                                    />
                                </div>
                               <div class="py-2 ">
                                <label class="text-gray-600 font-bold" for="fechaingreso">
                                    {{__('date of admission')}}:
                                </label>
                               </div>
                                <div class="">
                                    <input id="fechaingreso" class="-intro-x login__input form-control py-3 px-4 block" type="date"
                                    wire:model="fechaingreso" :value="old('fechaingreso')" required 
                                    />
                                </div>
                            </div>
                          
                            <div class=" -intro-x grid grid-cols-1 lg:grid-cols-2 py-2">
                                <div class="flex flex-col">
                                    <label class="text-gray-600 font-bold" for="DateBirth">
                                        {{__('Birthday')}}:
                                    </label>
                                    <input id="DateBirth" class="-intro-x login__input form-control py-3  w-full" type="date"
                                        wire:model="DateBirth" :value="old('DateBirth')" required
                                         /> 
                                </div>                                 
                                <div class="lg:ml-2">
                                    <label class="text-gray-600 font-bold" for="DateBirth">
                                        {{__('Enter your SSN')}}:
                                    </label>
                                    <input id="SSN" class="-intro-x  form-control py-3   w-full "
                                                type="text" wire:model="SSN" :value="old('SSN')" required
                                                    placeholder="{{__('Enter your SSN')}}"
                                                    />
                                            @error('SSN') 
                                    <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                    </div>  @enderror
                                </div>
                            </div>

                            {{-- DATOS DEL SISTEMA --}}
                            <span class="-intro-x   font-bold uppercase text-lg">{{__('System Data')}}:</span>    
                            <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 lg:gap-4"> 
                                <div class="w-full">
                                        <label class="text-gray-600 font-bold" for="Invitedby"> {{__('Invited by')}}:</label>
                                        <input id="Invitedby" class="-intro-x login__input form-control py-3" type="text"
                                            wire:model="invitedby" wire:change="datahijos"  :value="old('invitedby')" required />
                                            @if ($nohijos)
                                                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">Socio No Existe</span>
                                                </div>
                                            @endif
                                            
                                </div>                          
                                <div class="w-full mt-2 lg:mt-0">
                                    <div class="col-1">
                                        <label class="text-gray-600 font-bold" for="Invitedby">{{__('Username')}}:</label>
                                    </div>
                                    <div class="col-2">
                                        <input id="userName" class="-intro-x  form-control py-3  "
                                        type="text" wire:model="userName" :value="old('userName')" required
                                            placeholder="{{__('Username')}}"
                                            />
                                            @error('userName') 
                                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                    </div>
                                </div> 
                            </div>
                            {{-- caja para password y confirm password --}} 
                            <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 gap-2 mt-3">
                                    <div >
                                            <label for="Password" class="-intro-x text-gray-600 font-bold"> 
                                                    {{__('Password')}}
                                            </label>
                                            <input id="Password" class="-intro-x  form-control py-3"   type="text" wire:model="Password"
                                            required />
                                            @error('Password') 
                                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                                            </div>  
                                            @enderror
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="-intro-x w-full ">
                                            <label for="password_confirmation" class="-intro-x text-gray-600 font-bold"> 
                                                        {{__('Confirm Password')}}
                                            </label>
                                            <input id="password_confirmation" class="-intro-x  form-control py-3" type="text"
                                                wire:model="password_confirmation" placeholder="Besanabg2023"  required value="Besanabg2023"/>
                                                @error('password_confirmation') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                                                </div>  @enderror
                                    </div>   
                            </div>
                            <div class="-intro-x grid grid-cols-2 gap-2 mt-3">
                                <div class="w-full p-3">
                                    <input type="checkbox" class="-intro-x bg-primary " style=" input:checked {
                                        background-color:green;
                                    }" wire:model="asignarSocio">
<h1>{{$asignacionSocio}}</h1>
                                    <span>{{__('Do you want to make a placement')}}? </span>
                                    @if ($asignarSocio)
                                        <div wire:ignore>
                                            <select class="form-control" id="select2-dropdown" wire:model='asignacionSocio'>
                                                <option value="">{{__('Select Partner')}}</option>
                                                @foreach($SonAfiliate as $item)
                                                <option value="{{ $item['idAffiliated']}}">{{ $item['userName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>

                </div>   
            
                {{-- fin columna uno --}}
                <div class="col-2  bg-gray-300 md:border-l-4 md:border-primary p-2">
                                <span class="-intro-x  font-bold uppercase text-lg ">{{__('CONTACT INFORMATION')}}:</span>  
                                <div class=" grid grid-cols-1 lg:grid-cols-2 gap-4 w-full">
                                        <input id="AlternativePhone" class="-intro-x login__input form-control py-3 block" type="number" wire:model="AlternativePhone"
                                                :value="old('AlternativePhone')" required autofocus placeholder="{{__('Cell phone')}}" />
                                        <input id="WorkPhone" class="-intro-x login__input form-control py-3 block" type="number" wire:model="WorkPhone"
                                                :value="old('WorkPhone')"  autofocus placeholder="{{__('Phone')}}"  />
                                </div> 
                                {{-- Email  --}}
                                <div class="w-full mt-2">
                                    <label class="-intro-x text-gray-600 font-bold" for="Email"> {{__('Email')}}:</label>
                                        <input id="Email" class="-intro-x login__input form-control py-3 block" type="Email" wire:model="Email"
                                            :value="old('Email')" required autofocus placeholder="{{__('Email')}}" />
                                            @error('Email') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                </div>
                                {{-- confirm email --}}
                                <div class="w-full mt-2 mb-3">
                                    <label class="-intro-x text-gray-600 font-bold" for="confirmEmail"> {{__('Confirm Email')}}:</label>
                                    <input id="confirmEmail" class="-intro-x login__input form-control py-3 block" type="email" wire:model="confirmEmail"
                                            :value="old('confirmEmail')" required autofocus placeholder="{{__('Confirm Email')}}"/>
                                            @error('confirmEmail') <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                                            </div>  @enderror
                                </div>  
                                {{-- addres  --}}
                                <span class="-intro-x  font-bold uppercase text-lg ">{{__('LOCATION DATA')}}:</span>  
                                <div class="w-full grid grid-cols-1">
                                        <label class="-intro-x text-gray-600 font-bold" for="Address"> 
                                                {{__('Address')}}:
                                        </label>
                                        <input
                                         placeholder="{{__('Address')}}"
                                        id="Address" class="-intro-x login__input form-control py-3 block" type="text" wire:model="Address"
                                            :value="old('Address')" required autofocus />
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2">
                                    <div class="grid grid-cols-1">
                                            <label class="-intro-x text-gray-600 font-bold"  for="Country"> {{__('Country')}}:</label>
                                            <input id="Country" class="-intro-x login__input form-control py-3 block" type="text" wire:model="Country"
                                                    :value="old('Country')" required placeholder="Usa"/>
                                    </div>
                                        <!-- State/Province -->
                                    <div class="grid grid-cols-1 ml-0 lg:ml-2">
                                        <label class="-intro-x text-gray-600 font-bold" for="State"> {{__('State')}}:</label>
                                        <input id="State" class="-intro-x login__input form-control py-3 block" type="text" wire:model="State"
                                                :value="old('State')" required autofocus />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 mt-3">
                                    <div class="grid grid-cols-1">
                                        <label class="-intro-x text-gray-600 font-bold" for="City"> {{__('City')}}:</label>
                                        <input id="City" class="-intro-x login__input form-control py-3 block" type="text" wire:model="City"
                                                :value="old('City')" required autofocus />
                                    </div>
                                    <div class="grid grid-cols-1 ml-0 lg:ml-2">
                                        <label class="-intro-x text-gray-600 font-bold"  for="ZipCode"> {{__('ZipCode')}}:</label>
                                        <input id="ZipCode" class="-intro-x login__input form-control py-3 block" type="text" wire:model="ZipCode"
                                                :value="old('ZipCode')" required autofocus />
                                    </div>
                                </div>
                                <div class="flex flex-col lg:flex-row lg:justify-evenly p-4">
                                    <div>

                                        <input type="checkbox" class="-intro-x bg-primary " style=" input:checked {
                                            background-color:green;
                                        }" wire:model="terminos">
                                        <span>{{__('Accept to')}} <button onclick="terminos()">{{__('Terms and Conditions')}}</button> </span>
                                    </div>
                                    <a class="intro-x login__input underline text-sm text-gray-600 hover:text-gray-900 mr-3 text-center" href="{{ route('login') }}">
                                        {{__('You are already registered')}}?
                                    </a>
                                </div>
                                <div class="flex justify-center lg:justify-end">
                                    <button 
                                        @if ($terminos==false)
                                            disabled
                                        @else 
                                            
                                        @endif
                                    class="btn btn-primary py-3 px-4 w-full lg:w-32  " type="submit">
                                        {{__('Register')}}
                                    </button>
                                    
                                </div>
                            
                </div>
                
                </form>
        </div>
   
        <script>
            
                $('#select2-dropdown').select2();
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2("val");
                    @this.set('ottPlatform', data);
                });
          
        </script>
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
                // Swal.fire('', event.detail.msg)
                // if (event.detail.action == 'close-modal') fireModal(0)
                    Swal.fire(
                    'Mensaje',
                    event.detail.msg,
                    'info'
                    ).then(result => {
                        if(result.isConfirmed){
                            // window.location = '/socioactivo'
                        }
                    }
                        
                    )
             
            })
            window.addEventListener('error', event => {
                // Swal.fire('', event.detail.msg)
                // if (event.detail.action == 'close-modal') fireModal(0)
                    Swal.fire(
                    'Error',
                    event.detail.msg,
                    'error'
                    ).then(result => {
                        if(result.isConfirmed){
                           
                        }
                    }
                        
                    )
             
            })
           
            function terminos(){
                Swal.fire({
                title: 'Terminos y Condiciones',
                text: 'Mensaje de prueba',
                // imageUrl: 'https://unsplash.it/400/200',
                // imageWidth: 400,
                // imageHeight: 200,
                // imageAlt: 'Custom image',
                })
            }
            // window.onload = () => {
            // const myInput = document.getElementById('confirmEmail');
            // myInput.onpaste = e => e.preventDefault();
            // }
         
        </script>
    </div>

        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        
    </div>       
     
               
              
