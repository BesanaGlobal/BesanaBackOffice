@extends('../layout/' . $layout)

@section('subhead')
    <title>Listado de Afiliados | BesanaGlobal</title>
@endsection

@section('subcontent')

    <h2 class="intro-y text-lg font-medium mt-10 pb-5">Mis Afiliados</h2>
    <livewire:affiliates-table />


@endsection




