<div class="container">
    <!-- BEGIN: Login Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
        <div class="col-1 p-2">
            <form wire:submit.prevent="update">
            @csrf
                <span class="font-bold uppercase text-lg">{{__('personal information')}}:</span>
                <div class="w-full">
                    <div class="py-2">
                        <label class="text-gray-600 font-bold" for="Name">{{__('Name')}}:</label>
                        <input id="Name" placeholder="{{__('Enter your name')}}" class="-intro-x login__input form-control py-3 " type="text" wire:model="Name" :value="old('Name')" required autofocus />
                    </div>
                    <div class="">
                        <label class="text-gray-600 font-bold" for="LastName">{{__('LastName')}}:</label>
                        <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block" type="text" wire:model="LastName" :value="old('LastName')" required placeholder="{{__('Enter your lastname')}}" />
                    </div>
                </div>
                <div class="w-full">
                    <div class="pt-2">
                        <label class="text-gray-600 font-bold" for="DateBirth">{{__('Birthday')}}:</label>
                        <input id="DateBirth" class="-intro-x login__input form-control py-3 w-full" type="date" wire:model="DateBirth" :value="old('DateBirth')" required />
                    </div>
                </div>
                <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 lg:gap-4 pb-4">
                    <div class="pt-2">
                        <label class="text-gray-600 font-bold" for="city-select">{{__('Origin')}}:</label>
                        <select name="city-select" id="city-select" class="form-control" wire:model="selectCity" required>
                            <option value="1">EE UU</option>
                            <option value="2">MEXICO</option>
                            <option value="3">GUATEMALA</option>
                            <option value="4">PANAMÁ</option>
                        </select>
                    </div>
                    @if($selectCity == 1)
                    <div class="pt-2" id="SSN-DIV">
                        <label class="text-gray-600 font-bold" for="SSN">{{__('Enter your SSN')}}:</label>
                        <input id="SSN" class="-intro-x  form-control w-full" type="text" wire:model="SSN" placeholder="{{__('Enter your SSN')}}" />
                        @error('SSN')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectCity == 2)
                    <div class="pt-2" id="RFC-DIV">
                        <label class="text-gray-600 font-bold" for="RFC">{{__('Enter your RFC')}}:</label>
                        <input id="RFC" class="-intro-x  form-control w-full" wire:model="RFC" type="text" placeholder="{{__('Enter your RFC')}}" />
                        @error('RFC')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="pt-2" id="CURP-DIV">
                        <label class="text-gray-600 font-bold" for="CURP">{{__('Enter your CURP')}}:</label>
                        <input id="CURP" class="-intro-x  form-control w-full" wire:model="CURP" type="text" placeholder="{{__('Enter your CURP')}}" />
                        @error('CURP')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectCity == 3)
                    <div class="pt-2" id="DPI-DIV">
                        <label class="text-gray-600 font-bold" for="DPI">{{__('Enter your DPI')}}:</label>
                        <input id="DPI" class="-intro-x  form-control w-full" wire:model="DPI" type="text" placeholder="{{__('Enter your DPI')}}" />
                        @error('DPI')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if($selectCity == 4)
                    <div class="pt-2" id="DPI-DIV">
                        <label class="text-gray-600 font-bold" for="DPI">{{__('Enter your ID Personal')}}:</label>
                        <input id="IP" class="-intro-x  form-control w-full" wire:model="IP" type="text" placeholder="{{__('Enter your ID Personal')}}" />
                        @error('IP')
                        <div class="intro-x bg-red-600 p-2 rounded-lg ">
                            <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    @endif
                </div>
                {{-- DATOS DEL SISTEMA --}}
                <span class="-intro-x font-bold uppercase text-lg pt-5">{{__('System Data')}}:</span>
                <div class=" w-full">
                    <div class="py-2">
                        <label class="text-gray-600 font-bold" for="fechaingreso">{{__('date of admission')}}:</label>
                        <input id="fechaingreso" class="-intro-x login__input form-control py-3 px-4 block" type="text" wire:model="fechaingreso" :value="old('$fechaingreso')"  readonly />
                    </div>
                </div>
                <div class="-intro-x grid grid-cols-1 lg:grid-cols-2 lg:gap-4">
                    <div class="w-full mt-2 lg:mt-0">
                        <div class="col-1">
                            <label class="text-gray-600 font-bold" for="userName">{{__('Username')}}:</label>
                        </div>
                        <div class="col-1">
                            <input id="userName" class="-intro-x form-control py-3 " type="text" wire:model="userName" :value="old('userName')" required placeholder="{{__('Username')}}" />
                            @error('userName')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full mt-2 lg:mt-0">
                        <div class="col-1">
                            <label class="text-gray-600 font-bold" for="rankName">{{__('RankName')}}:</label>
                        </div>
                        <div class="col-1">
                            <select id="idRank"  name="idRank"  wire:model="idRank" class="form-control" required>
                                <option disabled></option>
                                @foreach($rank as $value)
                                    <option value="{{ $value->idRank }}">{{ $value->RankName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="w-full p-3">
                    <input type="checkbox" class="-intro-x bg-primary " style="background-color:green;" wire:model="selectBankAccount">
                    <span>Quiere recibir los pagos mediante transferencia bancaria?</span>
                    @if ($selectBankAccount)
                    <div wire:ignore class="pt-3">
                        <input type="text" class="-intro-x  form-control mt-3" id="bankAccount" name="bankAccount" wire:model="bankAccount" value="{{$bankAccount}}" placeholder="Ingrese Número de cuenta bancaria" />
                        <input type="text" class="-intro-x  form-control mt-3" id="routingNumber" name="routingNumber" wire:model="routingNumber" value="{{$routingNumber}}" placeholder="Ingrese Número de ruta bancaria" />
                        <select name="typeAccount" id="typeAccount" class="form-control mt-3"  wire:model='typeAccount'>
                            <option value="Checking">Checking</option>
                            <option value="Saving">Saving</option>
                        </select>
                        <input type="checkbox" class="-intro-x bg-primary " style="background-color:green;" wire:model="Authorization">
                        <span>Yo <button class="intro-x underline text-sm text-info fw-bold hover:text-gray-900 mt-5" onclick="authorization()">Autorizo.</button></span>
                    </div>
                    @endif
                </div>
        </div>
        {{-- fin columna uno --}}
        <div class="col-2  bg-gray-300 md:border-l-4 md:border-primary p-2">
            <span class="-intro-x  font-bold uppercase text-lg pb-5">{{__('CONTACT INFORMATION')}}:</span>
            <div class=" grid grid-cols-1 lg:grid-cols-2 w-full pt-3">
                <label class="-intro-x text-gray-600 font-bold" for="areaCodeWorkPhone"> {{__('WorkPhone')}}:</label> 
                <label class="-intro-x text-gray-600 font-bold pl-2" for="areaCodeAlternativePhone"> {{__('AlternativePhone')}}:</label>
                <div class="input-group">
                    <select name="areaCodeWorkPhone" id="areaCodeWorkPhone" wire:model="AreaCodeWorkPhone" class="form-control" style="width:100px">
                        <option value="+">+</option>
                        <option disabled></option>
                        @foreach($AreaCode as $value)
                            <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input id="WorkPhone" class="-intro-x  form-control " type="text" wire:model="WorkPhone" :value="old('WorkPhone')" autofocus placeholder="{{__('Phone')}}" />
                </div>            
                <div class="input-group pl-2">
                    <select name="areaCodeAlternativePhone" id="areaCodeAlternativePhone" wire:model="AreaCodeAlternativePhone" class="form-control" style="width:100px">
                        <option value="+" selected>+</option>
                        <option disabled></option>
                        @foreach($AreaCode as $value)
                            <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input id="AlternativePhone" class="-intro-x  form-control" type="text" wire:model="AlternativePhone" :value="old('AlternativePhone')" required autofocus placeholder="{{__('Cell phone')}}" />
                </div>
            
            </div>
            {{-- Email  --}}
            <div class="w-full mt-2 pb-4">
                <label class="-intro-x text-gray-600 font-bold" for="Email"> {{__('Email')}}:</label>
                <input id="Email" class="-intro-x login__input form-control py-3 block" type="Email" wire:model="Email" :value="old('Email')" required autofocus placeholder="{{__('Email')}}" />
                @error('Email')
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                </div>
                @enderror
            </div>
            {{-- addres  --}}
            <span class="-intro-x  font-bold uppercase text-lg">{{__('LOCATION DATA')}}:</span>
            <div class="w-full grid grid-cols-1 pt-3">
                <label class="-intro-x text-gray-600 font-bold" for="Address"> {{__('Address')}}: </label>
                <input placeholder="{{__('Address')}}" id="Address" class="-intro-x login__input form-control py-3 block" type="text" wire:model="Address" :value="old('Address')" required autofocus />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 pt-3">
                <div class="grid grid-cols-1">
                    <label class="-intro-x text-gray-600 font-bold" for="Country"> {{__('Country')}}:</label>
                    <input id="Country" name="Country" type="text" class="form-control" wire:model="selectedCountry" :value="old('selectCountry')" required>
                    <!-- <select wire:model="selectedCountry" id="Country" class="form-control">
                        <option selected disabled>Selecciona un País</option>
                        <option></option>
                        @foreach($Countries as $country => $value)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select> -->
                </div>
                <div class="grid grid-cols-1 ml-0 lg:ml-2">
                    <label class="-intro-x text-gray-600 font-bold" for="State"> {{__('State')}}:</label>
                    <input id="State" name="State" type="text" class="form-control" wire:model="selectedState" :value="old('selectState')" required>
                    <!-- <select wire:model="selectedState" id="State" class="form-control">
                        <option selected disabled>Selecciona un Estado</option>
                        <option></option>
                        @if (!is_null($States))
                        @foreach($States as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                        @endif
                    </select> -->
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 mt-3">
                <div class="grid grid-cols-1">
                    <label class="-intro-x text-gray-600 font-bold" for="City"> {{__('City')}}:</label>
                    <input type="text" class="form-control" wire:model="selectedCity" :value="old('selectCity')" required>
                </div>
                <div class="grid grid-cols-1 ml-0 lg:ml-2">
                    <label class="-intro-x text-gray-600 font-bold" for="ZipCode"> {{__('ZipCode')}}:</label>
                    <input id="ZipCode" class="-intro-x login__input form-control py-3 block" type="text" wire:model="ZipCode" :value="old('ZipCode')" required autofocus />
                </div>
            </div>

            <div class="flex justify-center lg:justify-end pt-5">
                <a href="{{ route('ListUsers') }}" class="btn btn-dark py-3 px-4 w-full lg:w-32 mr-5">Regresar</a>
                <button class="btn btn-primary py-3 px-4 w-full lg:w-32" type="submit">
                    {{__('Save')}}
                </button>
            </div>
        </div>
        </form>
    </div>

         <!-- <div>
            <input type="text" id="dataVieja" name="dataVieja" wire:model="claveVieja" value="">
            <input type="text" id="dataNueva" name="dataNueva" wire:model="claveNueva" value="">
            <button  wire:click="like">Cambiar</button>
        </div> -->
</div>


<script>

    window.addEventListener('noty', event => {
        Swal.fire('',event.detail.msg)
    });

    function authorization() {
        const texto = `Autorizo a Besana Global a iniciar depósitos y, 
                        si es necesario, retiros para corregir entradas de depósito erróneas en mi(s) cuenta(s) 
                        enumeradas anteriormente. Entiendo que esta autorización reemplaza 
                        cualquier autorización anterior y permanecerá vigente hasta que la 
                        compañía mencionada anteriormente haya recibido una notificación 
                        por escrito de mi parte sobre su terminación en un tiempo suficiente para actuar.`;
        Swal.fire({
            title: 'Authorization',
            text: texto,
        })
    };

</script>