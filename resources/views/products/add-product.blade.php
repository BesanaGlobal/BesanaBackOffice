@extends('../layout/side-menu')

@section('subhead')
    <title>CRUD Form - Midone - Tailwind HTML Admin Template</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>

@endsection

@section('subcontent')

    <div class="card">
        <div class="intro-y mt-5 box">

                                
                                    <!-- BEGIN: Modal Toggle -->
                                    <div class="text-left my-5">
                                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="btn btn-primary">Agregar un producto</a>
                                    </div>
                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (session('success'))
                                                <div class="alert alert-success">
                                                   <span class="text-white text-xl">{{ session('success') }}</span> 
                                                </div>
                                            @endif
                                    <!-- END: Modal Toggle -->
                                    <!-- BEGIN: Modal Content -->
                                    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- BEGIN: Modal Header -->
                                                <div class="modal-header">
                                                    <h2 class="font-medium text-base mr-auto">Nuevo Producto</h2>
                                                   
                                                </div>
                                                <!-- END: Modal Header -->
                                                <!-- BEGIN: Modal Body -->
                                                
                                                <form action="{{route('addproduct.create')}}" method="POST" enctype="multipart/form-data" id="formulario">
                                                    @csrf
                                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                    <input id="idproducto" type="number" name="idproducto" value="0"  required>
                                                    
                                                    <div class="col-span-12 ">
                                                        <label for="modal-form-1" class="form-label">Nombre:</label>
                                                        <input id="modal-form-1" type="text" name="name" class="form-control" placeholder="Producto" required>
                                                    </div>
                                                    <div class="col-span-12 ">
                                                        <label for="modal-form-2" class="form-label">Descripción:</label>
                                                        <input name="descripcion" id="modal-form-2" type="text" class="form-control" placeholder="Descripción del producto" required>
                                                    </div>
                                                    <div class="col-span-12 ">
                                                        <label for="modal-form-4" class="form-label">Imagen</label>
                                                        <input name="image" id="modal-form-4" type="file" class="form-control" >
                                                    </div>
                                                    <div class="col-span-12 ">
                                                        <label for="modal-form-5" class="form-label">Precio:</label>
                                                        <input id="modal-form-5" name="precio" type="number" class="form-control" step="any" min="0" max="1000" required>
                                                    </div>
                                                    <div class="col-span-12 ">
                                                        <label for="modal-form-5" class="form-label">Puntos:</label>
                                                        <input id="modal-form-5" name="puntos" type="number" class="form-control" required>
                                                    </div>
                                                    <div class="col-span-12 ">
                                                        <label for="modal-form-6" class="form-label">Linea de Producto</label>
                                                        <select name="linea" id="modal-form-6" class="form-select" required>
                                                            @foreach ($lines as $li )
                                                            <option value="{{$li->idLine}}">{{$li->Line}}</option>
                                                            @endforeach
                                                            
                                                          
                                                        </select>
                                                    </div>
                                                
                                                </div>
                                                <!-- END: Modal Body -->
                                                <!-- BEGIN: Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                                                    <button type="submit" class="btn px-2 py-3  text-white w-20" style="background-color: green">Guardar</button>
                                                </div>
                                            </form>
                                                <!-- END: Modal Footer -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Modal Content -->
                                
                            
        </div>
        <div class="card-body">

            <livewire:productdatatble
            model="App\Models\Product"
            searchable="name"
            sort="name"
            exportable
           
            />

        </div>
    </div>

@endsection

@push('javas')
@livewireScripts
<script>
  function editar(id){
      console.log(id);
  }
  
</script>
   
@endpush


   



