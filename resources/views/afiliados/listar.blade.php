@extends('../layout/' . $layout)

@section('subhead')
    <title>{{__('List of Affiliates')}} | BesanaGlobal</title>
@endsection

@section('subcontent')

    <h2 class="intro-y text-lg font-medium mt-10 pb-5">{{__('My Affiliates')}} </h2>
    <livewire:affiliates-table />


@endsection




