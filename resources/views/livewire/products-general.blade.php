<div>
    <div class="container">
        <form wire:submit.prevent="create">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
                <div class="col-1 p-2">
                    <span class="font-bold uppercase text-lg">Nuevo Producto:</span>
                    <div class="w-full pb-3 pt-5">
                        <label class="text-gray-600 font-bold" for="productName">Nombre del producto:</label>
                        <input type="text" id="productName" name="productName" wire:model="productName" class="form-control" value="">
                        @error('productName')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="lineProduct">Linea del producto:</label>
                        <select name="lineProduct" id="lineProduct" class="form-control" wire:model="selectedLineProduct">
                            <option disabled selected>Seleccione</option>
                            <option disabled></option>
                            @foreach($lineProduct as $line)
                                <option value="{{$line->idLine}}">{{$line->Line}}</option>
                            @endforeach
                        </select>
                        @error('selectedLineProduct')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="priceProduct">Precio del producto ($):</label>
                        <input type="number" id="priceProduct" name="priceProduct" class="form-control" wire:model="priceProduct" value=""> 
                        @error('priceProduct')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror        
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="pointsProductOffice">Puntos del producto (backOffice):</label>
                        <input type="number" id="pointsProductOffice" name="pointsProductOffice" class="form-control" value="" wire:model="pointsProductOffice">
                        @error('pointsProductOffice')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="pointsProductWeb">Puntos del producto (webSite):</label>
                        <input type="number" id="pointsProductWeb" name="pointsProductWeb" class="form-control" value="" wire:model="pointsProductWeb">
                        @error('pointsProductWeb')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="skuProduct">SKU:</label>
                        <input type="text" id="skuProduct" name="skuProduct" class="form-control" value="" wire:model="skuProduct">
                        @error('skuProduct')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label class="text-gray-600 font-bold" for="descriptionProduct">Descripción del producto:</label>
                        <textarea name="descriptionProduct" id="descriptionProduct" class="form-control" wire:model="descriptionProduct" cols="30" rows="10"></textarea>     
                        @error('descriptionProduct')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full">
                        
                    
                    <label for="imagen">Selecciona una imagen:</label>
        <input wire:model="imagen" type="file" id="imagen" class="dropify">


                    </div>
                </div>
                {{-- fin columna uno --}}
                <div class="col-2  bg-gray-300 md:border-l-4 md:border-primary p-2">
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="directionProduct">Dirección del producto:</label>
                        <textarea name="directionProduct" id="directionProduct" class="form-control" wire:model="directionProduct" cols="30" rows="10"></textarea>
                        @error('directionProduct')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="ingredients">Ingredientes del producto:</label>
                        <textarea name="ingredients" id="ingredients" class="form-control" wire:model="ingredients" cols="30" rows="10"></textarea>
                        @error('ingredients')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full flex justify-end">
                        <button type="button" id="comeBack" name="comeBack" class="btn btn-lg btn-dark mr-5">Regresar</button>
                        <button type="submit" id="Save" name="Save" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
   
    $(document).ready(function () {
        // Inicializa Dropify en el campo de carga de archivos con la clase "dropify"
        $('.imagen  ').dropify();
    });


</script>