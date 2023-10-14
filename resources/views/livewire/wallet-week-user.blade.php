
<div class="container">

@if(count($dataPay)>0)
    <span class="font-bold uppercase text-lg pb-5">Pagos Realizados (Semanal):</span>
    <table class="table table-bordered mt-5 mb-5">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <h4>Fecha de Asignación</h4>
                </th>
                <th style="text-align: center;">
                    <h4>Fecha de Solicitud</h4>
                </th>
                <th style="text-align: center;">
                    <h4>Cantidad Asignada</h4>
                </th>
                <th style="text-align: center;">
                    <h4>Estatus</h4>
                </th>
                <th style="text-align: center;">
                    <h4>Tipo de Pago</h4>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataPay as $value)
                <tr>
                    <td style="text-align: center;">{{$value->fechaInicio}}</td>
                    <td style="text-align: center;">{{$value->FechaFin ? $value->FechaFin : '-'}}</td>
                    <td style="text-align: center;">{{$value->total}}</td>
                    <td style="text-align: center;">{{$value->estado}}</td>
                    <td style="text-align: center;">{{$value->tipopago ? $value->tipopago : '-'}}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
@endif()





    <form wire:submit.prevent="CreatePay">

    <span class="font-bold uppercase text-lg pb-5 mt-5">{{__('personal information')}}:</span>

        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
            <div class="col-1 p-2">
                <label for="Name" class="block text-sm font-medium text-slate-700 py-3">Nombre</label>
                <input id="Name" class="-intro-x login__input form-control" type="text" value="{{$data[0]->Name}}" readonly />
                <label for="LastName" class="block text-sm font-medium text-slate-700 mt-3">Apellido</label>
                <input id="LastName" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="{{$data[0]->LastName}}" readonly/>
                <label for="UserName" class="block text-sm font-medium text-slate-700 mt-3">Nombre de Usuario</label>
                <input id="UserName" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="{{$data[0]->user->userName}}" readonly />
                @if($data[0]->BankAccount == "" && $data[0]->RoutingNumber == "" && $data[0]->TypeAccount == "")
                    <label for="bankAccount" class="block text-sm font-medium text-slate-700 mt-3">N° Cuenta Bancaria</label>
                    <input id="bankAccount" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="No Posee" readonly />
                    <label for="routingNumber" class="block text-sm font-medium text-slate-700 mt-3">N° Ruta Bancaria</label>
                    <input id="routingNumber" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="No Posee" readonly />
                    <label for="typeAccount" class="block text-sm font-medium text-slate-700 mt-3">Tipo de Cuenta Bancaria</label>
                    <input id="typeAccount" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="No Posee" readonly />
                @else
                    <label for="bankAccount" class="block text-sm font-medium text-slate-700 mt-3">N° Cuenta Bancaria</label>
                    <input id="bankAccount" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="{{$data[0]->BankAccount}}" readonly />
                    <label for="routingNumber" class="block text-sm font-medium text-slate-700 mt-3">N° Ruta Bancaria</label>
                    <input id="routingNumber" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="{{$data[0]->RoutingNumber}}" readonly />                
                    <label for="typeAccount" class="block text-sm font-medium text-slate-700 mt-3">Tipo de Cuenta Bancaria</label>
                    <input id="typeAccount" class="-intro-x login__input form-control py-3 px-4 block" type="text" value="{{$data[0]->TypeAccount}}" readonly />                
                @endif
            </div>
            <div class="col-1 p-2">
                <div class="col">
                    <label for="Fecha_inicio" class="block text-sm font-medium text-slate-700 py-3">Fecha de pago</label>
                    <input id="Fecha_inicio"  class="-intro-x login__input form-control" type="date" value="" wire:model="date" required />
                    <label for="Monto" class="block text-sm font-medium text-slate-700 mt-3">Monto</label>
                    <input id="Monto" class="-intro-x login__input form-control py-3 px-4 block" type="number" value="" wire:model="mount" required/>
                    <a href="{{ route('weeklist') }}" class="btn btn-dark py-3 px-4 w-full lg:w-32  mt-5">Regresar</a>
                    <button class="btn btn-primary py-3 px-4 w-full lg:w-32 mt-5" type="submit">{{__('Save')}}</button>
                </div>
            </div>
        </div>


    </form>
</div>


<script>
    window.addEventListener('error', event => {
        Swal.fire(
            'Error',
            event.detail.msg,
            'error'
        ).then(result => {
            if (result.isConfirmed) {

            }
        })
    })

    window.addEventListener('noty', event => {
        Swal.fire('',event.detail.msg).then(result => {
            if (result.isConfirmed) {
                window.location = '/WeekList'
            } 
        })
    }   )

</script>


















</div>
