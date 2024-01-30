<div>
    <div class="container">
        <div class="row">
            <div class="col text-right">
                <button type="button" class="btn btn-outline-primary mt-5 mb-5" onclick="comeHere()">Nuevo Producto</button>
            </div>
        </div>
    </div>
    <livewire:products-table />
</div>

<script>
    function comeHere(){
        window.location = '/productsCreate';
    }
</script>
