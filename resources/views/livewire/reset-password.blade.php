<div class="container">

    <div class="flex flex-col lg:w-1/2 lg:mx-auto">
        <div class="mb-5 mt-5">
            <span class="font-bold uppercase text-lg mb-5">Cambiar Contraseña</span>
        </div>
    </div>

    <div class="flex flex-col lg:w-1/2 lg:mx-auto">
        <div class="mb-5">
            <label for="newPass" class="form-text">Contraseña:</label>
            <div class="input-group">
                <input id="newPass" class="form-control" type="password" wire:model="newPass" required/>
                <button class="btn btn-outline-primary" type="button" id="viewpass" name="viewpass" onclick="viewPassOne()"><i id="iconoOne" class="fa-solid fa-eye"></i></button>
            </div>
            @error('newPass')
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                    <span class="-intro-x bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="confirPass" class="form-text">{{__('Confirm Password')}}:</label>
            <div class="input-group">
                <input id="confirPass" class="form-control" type="password" wire:model="confirPass" required/>
                <button class="btn btn-outline-primary" type="button" id="viewpass" name="viewpass" onclick="viewPassTwo()"><i id="iconoTwo" class="fa-solid fa-eye"></i></button>
            </div>
            @error('confirPass')
                <div class="intro-x bg-red-600 p-2 rounded-lg ">
                    <span class="bg-red-500 p-2 rounded-lg text-white ml-4">{{ $message }}</span>
                </div>
            @enderror
        </div>
    </div>

    <div class="flex flex-col lg:w-1/2 lg:mx-auto mt-3">
        <div class="text-right">
            <a href="{{ route('dash') }}" class="btn btn-dark ">Regresar</a>
            <button type="button" wire:click="alertConfirm" class="btn btn-primary ">Actualizar</button>
        </div>
    </div>

</div>

<script>

    function viewPassOne(){
        var typeInput =  document.getElementById("newPass");
        var i = document.getElementById("iconoOne"); 

        if (typeInput.type == 'password') {
            typeInput.type = 'text';
            i.className = 'fa-solid fa-eye-slash';
        }else{
            typeInput.type = 'password';
            i.className = ' fa-solid fa-eye';
        };
    }

    function viewPassTwo(){
        var typeInput =  document.getElementById("confirPass");
        var i = document.getElementById("iconoTwo"); 
        
        if (typeInput.type == 'password') {
            typeInput.type = 'text';
            i.className = 'fa-solid fa-eye-slash';
        }else{
            typeInput.type = 'password';
            i.className = ' fa-solid fa-eye';
        };
    }

    window.addEventListener('swal:modal', event => { 
    swal.fire({
      title: event.detail.message,
      icon: event.detail.type,
      buttons: true,
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Ok",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "{{route('dash')}}";
        }
    });
});


window.addEventListener('swal:confirm', event => { 
    Swal.fire({
        title: 'Ingrese su contraseña actual',
        input:'password',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        preConfirm: (currentPass) => {
            return Livewire.emit('update', currentPass);
        },
    });
});


</script>
