@extends('../layout/side-menu')

@section('subhead')
    <title>CRUD Form - Midone - Tailwind HTML Admin Template</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>

@endsection

@section('subcontent')
    <div class="intro-y flex  flex-row-reverse mb-5 mt-3">
        <a class="btn btn-primary ">Add Product</a>
    </div>
    <div class="card">
        <div class="card-body">
            
        </div>
    </div>
@endsection

@section('script')

@livewireScripts
   


@endsection
