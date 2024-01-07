<div class="container">
    <!-- BEGIN: Login Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
        <div class="col-1 p-2">
            <form wire:submit.prevent="update">
                @csrf
                <span class="font-bold uppercase text-lg">{{__('personal information')}}:</span>
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
                <div class=" grid grid-cols-1 lg:grid-cols-2 w-full pt-3 pb-4">
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
                {{-- addres  --}}
                <span class="-intro-x  font-bold uppercase text-lg">{{__('LOCATION DATA')}}:</span>
                <div class="w-full grid grid-cols-1 pt-3">
                    <label class="-intro-x text-gray-600 font-bold" for="Address"> {{__('Address')}}: </label>
                    <input placeholder="{{__('Address')}}" id="Address" class="-intro-x login__input form-control py-3 block" type="text" wire:model="Address" :value="old('Address')" required autofocus />
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 pt-3">
                    <div class="grid grid-cols-1">
                        <label class="-intro-x text-gray-600 font-bold" for="Country"> {{__('Country')}}:</label>
                        <!-- <input id="Country" name="Country" type="text" class="form-control" wire:model="selectedCountry" :value="old('selectCountry')" required> -->
                        <select wire:model="selectedCountry" id="Country" class="form-control">
                            <option selected disabled>Selecciona un País</option>
                            <option></option>
                            @foreach($Countries as $country => $value)
                            <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1 ml-0 lg:ml-2">
                        <label class="-intro-x text-gray-600 font-bold" for="State"> {{__('State')}}:</label>
                        <!-- <input id="State" name="State" type="text" class="form-control" wire:model="selectedState" :value="old('selectState')" required> -->
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
                    <a href="{{ route('dash') }}" class="btn btn-dark py-3 px-4 w-full lg:w-32 mr-5">Regresar</a>
                    <button class="btn btn-primary py-3 px-4 w-full lg:w-32" type="submit">{{__('Save')}}</button>
                </div>
            </div>
        </form>
    </div>
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