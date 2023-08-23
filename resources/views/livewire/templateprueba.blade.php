<div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto" >
   
    <div class=" bg-secundary w-full md:w-full  " style="width: 100%">
        >
                        @elseif($pais == 'mexico')
                            <div class="mt-4 md:w-1/2">
                                <label for="SSN" :value="__('Numero Frc * ')" />
                                <div class="flex text-xl gap-2 items-center">
                                    <i class="fas fa-id-card"></i>

                                    <input id="SSN" class="block mt-1 w-full md:w-3/4"
                                        type="text" wire:model="SSN" :value="old('SSN')" required
                                        placeholder="Ingrese su Frc " />

                                    {{-- <x-input-error :messages="$errors->get('SSN')" class="mt-2" /> --}}
                                </div>
                            </div>
                        @elseif($pais == 'colombia')
                            <div class="mt-4 md:w-1/2">
                                <label for="SSN" :value="__('Cédula de Ciudadanía * ')" />
                                <div class="flex text-xl gap-2 items-center">
                                    <i class="fas fa-id-card"></i>

                                    <input id="SSN" class="block mt-1 w-full md:w-3/4"
                                        type="text" wire:model="SSN" :value="old('SSN')" required
                                        placeholder="Ingrese su CC " />

                                    {{-- <x-input-error :messages="$errors->get('SSN')" class="mt-2" /> --}}
                                </div>
                            </div>
                        @endif

                    </div>

                    {{-- BackOffice Data --}}
                    <div class="mt-4">
                        <span class=" text-lg font-black">Datos de Sistema:</span>
                        <!-- invitedby -->

                        <label for="invitedby" :value="__('Invitado por:')" />

                        <input id="invitedby" class="block mt-1 w-full bg-gray-200" type="text"
                        wire:model="invitedby" readonly value="{{ $invitedby }}" />

                        {{-- <x-input-error :messages="$errors->get('invitedby')" class="mt-2" /> --}}
                    </div>

                    {{-- username --}}
                    <div class="md:flex w-full gap-2">
                        <div class="mt-4 md:w-1/3">
                            
                            

                                <input id="username" class="block mt-1 w-full md:w-3/4" type="text"
                                wire:model="userName" :value="old('username')" required
                                    placeholder="Ingrese su Usuario" />

                                {{-- <x-input-error :messages="$errors->get('username')" class="mt-2" /> --}}
                        
                        </div>
                        {{-- password        --}}
                        <div class="mt-4 md:w-1/3">
                            <label for="Password" :value="__('Contraseña* ')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fa-solid fa-lock"></i>

                                <input id="Password" class="block mt-1 w-full md:w-3/4" type="Password"
                                    wire:model="Password" :value="old('Password')" required />

                                {{-- <x-input-error :messages="$errors->get('Password')" class="mt-2" /> --}}
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4 md:w-1/3">
                            <label for="confirmPassword" :value="__('Confirmar Contraseña* ')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fa-solid fa-lock"></i>

                                <input id="confirmPassword" class="block mt-1 w-full md:w-3/4"
                                    type="password" wire:model="confirmPassword" :value="old('confirmPassword')" required />

                                {{-- <x-input-error :messages="$errors->get('confirmPassword')" class="mt-2" /> --}}
                            </div>
                        </div>
                    </div>
                    <div class="bg-sky-700 text-white mt-2 p-2 rounded-lg">
                        <span class="text-xl">Datos Requeridos (*)</span>
                    </div>
                </div>
                {{-- Contact Data second column --}}

                <div class="w-full p-4 bg-gray-100 md:border-l-4 md:border-sky-500">

                    <!-- movil -->
                    <span class="text-lg font-black ">Datos de Contacto:</span>

                    <div class="flex w-full gap-2">
                        <div class="mt-2  w-2/4">
                            <label for="Phone" :value="__('Numero de Célular *')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fas fa-mobile"></i>
                                <input id="Phone" class="block mt-1 w-3/4" type="number"
                                wire:model="Phone" :value="old('Phone')" required autofocus />
                            </div>


                            {{-- <x-input-error :messages="$errors->get('Phone')" class="mt-2" /> --}}
                        </div>

                        <!-- PHONE -->

                        <div class="w-2/4 mt-2">
                            <label for="Workphone" :value="__('Telefono Alternativo*')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fas fa-phone"></i>
                                <input id="movil" class="block mt-1 w-3/4" type="number"
                                wire:model="Workphone" :value="old('Workphone')" required autofocus />
                            </div>


                            {{-- <x-input-error :messages="$errors->get('movil')" class="mt-2" /> --}}
                        </div>
                    </div>
                    <!-- email -->

                    <div class="w-full mt-2">
                        <label for="email" :value="__('Correo*')" />
                        <div class="flex text-xl gap-2 items-center">
                            <i class="fas fa-envelope-open-text"></i>
                            <input id="email" class="block mt-1 w-3/4" type="email" wire:model="Email"
                                :value="old('email')" required autofocus />
                        </div>

                        {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                    </div>
                    <div class="w-full mt-2">
                        <label for="confirmEmail" :value="__('Confirmar Correo*')" />
                        <div class="flex text-xl gap-2 items-center">
                            <i class="fas fa-envelope-open-text"></i>
                            <input id="confirmEmail" class="block mt-1 w-3/4" type="email"
                                name="confirmEmail" :value="old('confirmEmail')" required autofocus />
                        </div>

                        {{-- <x-input-error :messages="$errors->get('confirmEmail')" class="mt-2" /> --}}
                    </div>

                    <span class="text-lg font-black ">Ubicación:</span>

                    <!-- Address -->

                    <div class="w-full mt-2">
                        <label for="address" :value="__('Direccion*')" />
                        <div class="flex text-xl gap-2 items-center">
                            <i class="fas fa-map-marker-alt"></i>
                            <input id="address" class="block mt-1 w-3/4" type="text" wire:model="Address"
                                :value="old('Address')" required autofocus />
                        </div>


                        {{-- <x-input-error :messages="$errors->get('Address')" class="mt-2" /> --}}
                    </div>

                    <!-- Country -->

                    <div class="flex w-full gap-2">
                        <div class="mt-2  w-2/4">
                            <label for="Country" :value="__('Pais*')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fas fa-globe-americas"></i>
                                <input id="Country" class="block mt-1 w-3/4 uppercase" type="text"
                                    wire:model="Country" value="{{ $pais }}" required autofocus />
                            </div>


                            {{-- <x-input-error :messages="$errors->get('Country')" class="mt-2" /> --}}
                        </div>

                        <!-- State/Province -->
                @if ($pais == 'mexico')
                            <div class="w-2/4 mt-2">

                                <label for="State" :value="__('Estado*')" />

                                <div class="flex text-xl gap-2 items-center">
                                    <i class="fas fa-university"></i>
                                    <input id="state" class="block mt-1 w-3/4" type="text"
                                    wire:model="State" :value="old('State')" required autofocus />
                                </div>


                                {{-- <x-input-error :messages="$errors->get('State')" class="mt-2" /> --}}
                            </div>
                    </div>

                    <!-- City -->

                    <div class="flex w-full gap-2">
                        <div class="mt-2  w-2/4">
                            <label for="City" :value="__('Provincia*')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fas fa-city"></i>
                                <input id="City" class="block mt-1 w-3/4" type="text"
                                wire:model="City" :value="old('City')" required autofocus />
                            </div>


                            {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
                        </div>

                        <!-- Zip -->

                        <div class="mt-2  w-2/4">
                            <label for="zipcode" :value="__('Codigo Postal*')" />
                            <div class="flex text-xl gap-2 items-center">
                                <i class="fab fa-usps"></i>
                                <input id="zipcode" class="block mt-1 w-3/4" type="text"
                                    name="zipcode" :value="old('zipcode')" required autofocus />
                            </div>


                            {{-- <x-input-error :messages="$errors->get('city')" class="mt-2" /> --}}
                        </div>
                        @elseif ($pais=='guatemala')
                        <div class="w-2/4 mt-2">

                            <label for="State" :value="__('Municipio*')" />

                            <div class="flex text-xl gap-2 items-center">
                                <i class="fas fa-university"></i>
                                <input id="state" class="block mt-1 w-3/4" type="text"
                                wire:model="State" :value="old('State')" required autofocus />
                            </div>


                            {{-- <x-input-error :messages="$errors->get('city')" class="mt-2" /> --}}
                        </div>
                </div>

                <!-- City -->

                <div class="flex w-full gap-2">
                    <div class="mt-2  w-2/4">
                        <label for="City" :value="__('Departamento*')" />
                        <div class="flex text-xl gap-2 items-center">
                            <i class="fas fa-city"></i>
                            <input id="City" class="block mt-1 w-3/4" type="text"
                            wire:model="City" :value="old('City')" required autofocus />
                        </div>


                        {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
                    </div>

                    <!-- Zip -->

                    <div class="mt-2  w-2/4">
                        <label for="ZipCode" :value="__('Codigo Postal*')" />
                        <div class="flex text-xl gap-2 items-center">
                            <i class="fab fa-usps"></i>
                            <input id="ZipCode" class="block mt-1 w-3/4" type="text"
                                wire:model="ZipCode" :value="old('ZipCode')" required autofocus />
                        </div>


                        {{-- <x-input-error :messages="$errors->get('ZipCode')" class="mt-2" /> --}}
                    </div>
            @elseif ($pais=='colombia')

                <div class="w-2/4 mt-2">

                    <label for="State" :value="__('Pendiente Colombia*')" />

                    <div class="flex text-xl gap-2 items-center">
                        <i class="fas fa-university"></i>
                        <input id="State" class="block mt-1 w-3/4" type="text"
                        wire:model="State"  :value="old('State')" required autofocus />
                    </div>


                    {{-- <x-input-error :messages="$errors->get('State')" class="mt-2" /> --}}
                </div>
        </div>

        <!-- City -->

        <div class="flex w-full gap-2">
            <div class="mt-2  w-2/4">
                <label for="City" :value="__('Provincia Pendiente*')" />
                <div class="flex text-xl gap-2 items-center">
                    <i class="fas fa-city"></i>
                    <input id="City" class="block mt-1 w-3/4" type="text"
                    wire:model="City" :value="old('City')" required autofocus />
                </div>


                {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
            </div>

            <!-- Zip -->

            <div class="mt-2  w-2/4">
                <label for="ZipCode" :value="__('Codigo Postal*')" />
                <div class="flex text-xl gap-2 items-center">
                    <i class="fab fa-usps"></i>
                    <input id="ZipCode" class="block mt-1 w-3/4" type="text"
                    wire:model="ZipCode" :value="old('ZipCode')" required autofocus />
                </div>


                {{-- <x-input-error :messages="$errors->get('ZipCode')" class="mt-2" /> --}}
            </div>
            @endif
        </div>



</div>

</div>


<div class="flex items-center justify-end mt-4">
<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
@if ($pais!='usa')
    
{{ __('Ya tienes usuario?') }}
@endif
</a>

<button class="flex ml-4 bg-sky-700 w-1/4 p-5 justify-center">
    @if ($pais!='usa')
        
    {{ __('Registrate') }}
    @endif
</button>

{{-- TERMINA PAIS MEXICO GUATEMALA COLOMBIA --}}
@elseif ($pais == 'usa')
{{-- INICIA USA --}}

{{-- Personal Data first column --}}
<div class="w-full  p-4 bg-primary " style="width: 50%">
    <!-- Name -->

    <span class="text-lg font-black ">Personal Data:</span>

    <div class="w-full">
        <label for="Name" :value="__('Name *')" />
        <div class="flex text-xl gap-2 items-center">
            <i class="far fa-user"></i>
            <input placeholder="Enter your Name" id="Name" class="intro-x login__input form-control py-3 px-4 block"
                type="text" wire:model="Name" :value="old('Name')" required autofocus />
        </div>


        {{-- <x-input-error :messages="$errors->get('Name')" class="mt-2" /> --}}
    </div>

    <!-- Email Address -->
    <div class="mt-4 w-full">
        <label for="LastName" :value="__('LastName* ')" />
        <div class="flex text-xl gap-2 items-center">
            <i class="far fa-user"></i>

            <input id="LastName" class="intro-x login__input form-control py-3 px-4 block" type="text" wire:model="LastName"
                :value="old('LastName')" required placeholder="Enter your LastName" />

            {{-- <x-input-error :messages="$errors->get('LastName')" class="mt-2" /> --}}
        </div>
    </div>

    <div class="md:flex w-full">

        <!-- birtday -->
        <div class="mt-4 md:w-1/2">
            <label for="DateBirth" :value="__('DateBirth* ')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fas fa-bithday-cake"></i>

                <input id="DateBirth" class="intro-x login__input form-control py-3 px-4 block md:w-3/4" type="date" wire:model="DateBirth"
                    :value="old('DateBirth')" required placeholder="Enter your DateBirth" />

                {{-- <x-input-error :messages="$errors->get('DateBirth')" class="mt-2" /> --}}
            </div>
        </div>

    
            <!-- social security -->
            <div class="mt-4 md:w-1/2">
                <label for="SSN" :value="__('Social Security* ')" />
                <div class="flex text-xl gap-2 items-center">
                    <i class="fas fa-id-card"></i>

                    <input id="SSN" class="intro-x login__input form-control py-3 px-4 block md:w-3/4" type="text"
                        wire:model="SSN" :value="old('SSN')" required
                        placeholder="Enter your Social Security" />

                    {{-- <x-input-error :messages="$errors->get('SSN')" class="mt-2" /> --}}
                </div>
            </div>
    

    

    </div>

    {{-- BackOffice Data --}}
    <div class="mt-4">
        <span class=" text-lg font-black">BackOffice Data:</span>
        <!-- invitedby -->

        <label for="invitedby" :value="__('Invited by:')" />

        <input id="invitedby" class="intro-x login__input form-control py-3 px-4 block" type="text" wire:model="invitedby"
            readonly value="{{ $invitedby }}" />

        {{-- <x-input-error :messages="$errors->get('invitedby')" class="mt-2" /> --}}
    </div>

    {{-- username --}}
    <div class="md:flex md:w-full gap-2">
        <div class="mt-4 md:w-1/3">
            <label for="userName" :value="__('userName* ')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fa-solid fa-user-secret"></i>

                <input id="userName" class="intro-x login__input form-control py-3 px-4 block md:w-3/4" type="text" wire:model="userName"
                    :value="old('userName')" required placeholder="Enter your userName" />

                {{-- <x-input-error :messages="$errors->get('userName')" class="mt-2" /> --}}
            </div>
        </div>
        {{-- password        --}}
        <div class="mt-4 md:w-1/3">
            <label for="Password" :value="__('Password* ')" />
            <div class="flex  text-xl gap-2 items-center text-dark">
                <i class="fa-regular fa-user text-dark "></i>

                <input id="Password" class="intro-x login__input form-control py-3 px-4 block md:w-3/4" type="text" wire:model="Password"
                    :value="12345678" required />

                {{-- <x-input-error :messages="$errors->get('Password')" class="mt-2" /> --}}
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 md:w-1/3">
            <label for="confirmPassword" :value="__('Confirm Password* ')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fa-solid fa-lock"></i>

                <input id="confirmPassword" class="intro-x login__input form-control py-3 px-4 block md:w-3/4" type="text"
                    wire:model="confirmPassword" :value="12345678" required />

                {{-- <x-input-error :messages="$errors->get('confirmPassword')" class="mt-2" /> --}}
            </div>
        </div>
    </div>
    <div class="bg-primary text-white mt-2 p-2 rounded-lg">
        <span class="text-xl">Requerid fields (*)</span>
    </div>
</div>
{{-- Contact Data second column --}}

<div class="w-full p-4 bg-gray-100 md:border-l-4 md:border-sky-500" style="width: 50%">

    <!-- movil -->
    <span class="text-lg font-black ">Contact Data:</span>

    <div class="flex w-full gap-2">
        <div class="mt-2  w-2/4">
            <label for="Workphone" :value="__('Phone Number *')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fas fa-mobile"></i>
                <input id="Workphone" class="block mt-1 w-3/4" type="number" wire:model="Workphone"
                    :value="old('Workphone')" required autofocus />
            </div>


            {{-- <x-input-error :messages="$errors->get('Workphone')" class="mt-2" /> --}}
        </div>

        <!-- PHONE -->

        <div class="w-2/4 mt-2">
            <label for="Phone" :value="__('Phone*')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fas fa-phone"></i>
                <input id="Phone" class="block mt-1 w-3/4" type="number" wire:model="Phone"
                    :value="old('Phone')" required autofocus />
            </div>


            {{-- <x-input-error :messages="$errors->get('Phone')" class="mt-2" /> --}}
        </div>
    </div>
    <!-- email -->

    <div class="w-full mt-2">
        <label for="Email" :value="__('Email*')" />
        <div class="flex text-xl gap-2 items-center">
            <i class="fas fa-envelope-open-text"></i>
            <input id="Email" class="block mt-1 w-3/4" type="Email" wire:model="Email"
                :value="old('Email')" required autofocus />
        </div>

        {{-- <x-input-error :messages="$errors->get('Email')" class="mt-2" /> --}}
    </div>
    <div class="w-full mt-2">
        <label for="confirmEmail" :value="__('Confirm Email*')" />
        <div class="flex text-xl gap-2 items-center">
            <i class="fas fa-envelope-open-text"></i>
            <input id="confirmEmail" class="block mt-1 w-3/4" type="email" name="confirmEmail"
                :value="old('confirmEmail')" required autofocus />
        </div>

        {{-- <x-input-error :messages="$errors->get('confirmEmail')" class="mt-2" /> --}}
    </div>

    <span class="text-lg font-black ">Ubication Data:</span>

    <!-- Address -->

    <div class="w-full mt-2">
        <label for="Address" :value="__('Address*')" />
        <div class="flex text-xl gap-2 items-center">
            <i class="fas fa-map-marker-alt"></i>
            <input id="Address" class="block mt-1 w-3/4" type="text" wire:model="Address"
                :value="old('Address')" required autofocus />
        </div>


        {{-- <x-input-error :messages="$errors->get('Address')" class="mt-2" /> --}}
    </div>

    <!-- Country -->

    <div class="flex w-full gap-2">
        <div class="mt-2  w-2/4">
            <label for="Country" :value="__('Country*')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fas fa-globe-americas"></i>
                <input id="Country" class="block mt-1 w-3/4" type="text" wire:model="Country"
                    :value="old('Country')" required autofocus />
            </div>


            {{-- <x-input-error :messages="$errors->get('Country')" class="mt-2" /> --}}
        </div>

        <!-- State/Province -->

        <div class="w-2/4 mt-2">
            <label for="State" :value="__('State/Province*')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fas fa-university"></i>
                <input id="State" class="block mt-1 w-3/4" type="text" wire:model="State"
                    :value="old('State')" required autofocus />
            </div>


            {{-- <x-input-error :messages="$errors->get('State')" class="mt-2" /> --}}
        </div>
    </div>

    <!-- City -->

    <div class="flex w-full gap-2">
        <div class="mt-2  w-2/4">
            <label for="City" :value="__('City*')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fas fa-City"></i>
                <input id="City" class="block mt-1 w-3/4" type="text" wire:model="City"
                    :value="old('City')" required autofocus />
            </div>


            {{-- <x-input-error :messages="$errors->get('City')" class="mt-2" /> --}}
        </div>

        <!-- Zip -->

        <div class="mt-2  w-2/4">
            <label for="ZipCode" :value="__('Zip code*')" />
            <div class="flex text-xl gap-2 items-center">
                <i class="fab fa-usps"></i>
                <input id="ZipCode" class="block mt-1 w-3/4" type="text" wire:model="ZipCode"
                    :value="old('ZipCode')" required autofocus />
            </div>


            {{-- <x-input-error :messages="$errors->get('ZipCode')" class="mt-2" /> --}}
        </div>
    </div>



</div>

</div>


<div class="flex items-center justify-end mt-4">
<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
    Already Registered?
</a>

<button class="flex ml-4 bg-sky-700 w-1/4 p-5 justify-center">
    Register
</button>

@endif

</div>
</form>
</div>