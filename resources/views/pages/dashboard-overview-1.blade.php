@extends('../layout/' . $layout)
@section('subhead')
    <title>Dashboard - Besana</title>
@endsection
@section('subcontent')

    <div class="grid grid-cols-10 gap-6">
        <div class="col-span-12 2xl:col-span-10">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Informe General</h2>
                        @if (session('success'))
                            <div class="alert alert-success text-white">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger text-white">
                                {{ session('danger') }}
                            </div>
                        @endif
                        @if(isset($afiliado))
                            @if ($afiliado->idAffiliated == 1)
                                <a href="{{route('walletRequest')}}" class="btn btn-sm btn-primary"> {{__('Request')}}</a>
                            @endif
                        @endif
                        @if(isset($website))
                        <!-- BEGIN: Modal Toggle -->
                            <div class="text-right ml-4">
                                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-preview" class="btn btn-sm btn-outline-primary btn-lg">{{__('My link')}}</a>
                            </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                            <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-10 text-center">
                                            <h2 class="mb-4">{{__('Link')}}</h2>
                                            <input id="textToCopy" type="text" class="form-control"  value="{{$website->webSite}}" placeholder="Mi link" readonly>
                                            <button id="copyButton" class="mt-4 btn btn-primary" onclick="copyToClipboard()">{{__('Copy')}}</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- END: Modal Content -->
                        @endif
                    </div>
                </div>
                <!-- END: General Report -->
            </div>
        </div>
    </div>


    <script>
        function copyToClipboard() {
            var textToCopy = document.getElementById('textToCopy');
            textToCopy.select();
            document.execCommand('copy');
            
            // Cambia el texto del botón después de copiar
            var copyButton = document.getElementById('copyButton');
            copyButton.innerHTML = "{{__('Copied')}}";
            copyButton.classList.add('copied');

            // Desactiva el botón después de copiar
            copyButton.disabled = true;

            // Elimina la clase de éxito después de un tiempo para que pueda reproducirse nuevamente
            setTimeout(function() {
                textToCopy.classList.remove('success');
                copyButton.innerHTML = "{{__('Copy')}}";
                copyButton.classList.remove('copied');
                copyButton.disabled = false;
            }, 2000);
        }
    </script>

@endsection