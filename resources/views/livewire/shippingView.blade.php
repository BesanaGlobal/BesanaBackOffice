<div class="container">
    <div class="row">
        <hr/>
        <h1 style="font-size: 20px;" class="pt-3 pb-5"><strong>Detalles de la venta</strong></h1>
        <div class="row pt-3">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <!-- <h4>La Paz, <a href="#">30</a> de <a href="#">abril</a> de 201<a href="#">4</a></h4> -->
                    </div>
                    <div class="panel-body">
                        <h4>Comprador : <strong>{{$data[0]->WebNameClient}}</strong></h4>
                        <h4>Correo : <strong>{{$data[0]->WebEmailClient}}</strong></h4>
                        <h4>Teléfono : <strong>{{$data[0]->WebWorkPhoneClient}}</strong></h4>
                        <h4>País : <strong>{{$data[0]->WebCountryClient}}</strong></h4>
                        <h4>Estado : <strong>{{$data[0]->WebStateClient}}</strong></h4>
                        <h4>Ciudad : <strong>{{$data[0]->WebCityClient}}</strong></h4>
                        <h4>Dirección : <strong>{{$data[0]->WebAddressClient}}</strong></h4>
                        <h4>Momento de Compra : <strong>{{$data[0]->datetimeb}}</strong></h4>
                        <hr>
                    </div>
                    <div class="panel-body pt-5">
                        <h4>Sponsor : <strong>{{$data[0]->affiliate->Name}} {{$data[0]->affiliate->LastName}}</strong></h4>
                    </div>
                </div>
            </div>
        </div>
        <pre></pre>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">
                        <h4>Cantidad</h4>
                    </th>
                    <th style="text-align: center;">
                        <h4>Producto</h4>
                    </th>
                    <th style="text-align: center;">
                        <h4>Precio</h4>
                    </th>
                    <th style="text-align: center;">
                        <h4>Total</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $value)
                    @foreach($value->detailSales as $dt)
                    <tr>
                        <td style="text-align: center;">{{$dt->cantidad}}</td>
                        <td><a href="#"> {{$dt->product->name}}</a></td>
                        <td class=" text-right ">$ {{$dt->precioVenta}}</td>
                        <td class=" text-right ">$ {{$dt->subtotal}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;">Total</td>
                        <td style="text-align: right;"> $ {{$value->price}} </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div class="py-3 text-right" >
            <button wire:click.prevent="updateSend" class="btn btn-primary btn-lg">Enviar</button>
            <a href="{{route('shipping')}}" class="btn btn-dark btn-lg">Regresar</a>
        </div>
    </div>
</div>

<script>

    window.addEventListener('noty', event => {
        Swal.fire('',event.detail.msg)
    })

</script>