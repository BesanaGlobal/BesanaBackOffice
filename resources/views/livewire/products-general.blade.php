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
                            <option selected>Seleccione</option>
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
                        <input type="number" id="priceProduct" name="priceProduct" class="form-control" wire:model="priceProduct" value="" step="any"> 
                        @error('priceProduct')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror        
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="pointsProductOffice">Puntos del producto (backOffice):</label>
                        <input type="number" id="pointsProductOffice" name="pointsProductOffice" class="form-control" step="any" value="" wire:model="pointsProductOffice">
                        @error('pointsProductOffice')
                            <div class="intro-x bg-red-600 p-2 rounded-lg ">
                                <span class="-intro-x bg-red-500 p-2 rounded-lg text-white">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="pointsProductWeb">Puntos del producto (webSite):</label>
                        <input type="number" id="pointsProductWeb" name="pointsProductWeb" step="any" class="form-control" value="" wire:model="pointsProductWeb">
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
                    <div class="w-full pt-2 pb-3">
                        <label for="imagen" class="text-gray-600 font-bold pb-4">Selecciona una imagen:</label>
                        <input wire:model="image" type="file" id="{{$identity}}" class="form-control pb-3">
                        <div wire:loading wire:target="image" class=" mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Imagen cargando!</strong>
                            <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado.</span>
                        </div>
                        @if ($image)
                            <img class="w-auto h-auto" src="{{ $image->temporaryUrl() }}">
                        @endif
                    </div>
                </div>
                {{-- fin columna uno --}}
                <div class="col-2  bg-gray-300 md:border-l-4 md:border-primary p-2">
                    <div class="w-full pb-3">
                        <label class="text-gray-600 font-bold" for="directionProduct">Dirección del producto:</label>
                        <textarea name="directionsProduct" id="directionsProduct" class="form-control" wire:model="directionsProduct" cols="30" rows="10"></textarea>
                        @error('directionsProduct')
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
                        <button type="button" id="comeBack" name="comeBack" class="btn btn-lg btn-dark mr-5" onclick="returnBack()">Regresar</button>
                        <button type="submit" id="Save" name="Save" wire:loading.attr="disabled" wire:target="create,image" class="btn btn-lg btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
   window.addEventListener('noty', event => {
        Swal.fire('',event.detail.msg)
    });

function returnBack(){
    window.location = "/productsData";
}
</script>