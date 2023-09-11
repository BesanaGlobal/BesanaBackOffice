@extends('../layout/' . $layout)

@section('subhead')
    <title>Recuperar Contraseña | BesanaGlobal</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
    
        <!-- BEGIN: Profile Menu -->
        
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">

                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Change Password</h2>
                </div>
                @if ($errors->has('message'))
                    <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success text-white">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="p-5">
                    <form action="{{route('sendEmailPassword')}}" method="post">
                        @csrf
                    <div class="mt-3">
                        <label for="email" class="form-label">Email Registrado</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="{{__('Email')}}" required>
                    </div>
                    <div class="flex justify-around">
                        <button type="submit" class="btn btn-primary mt-4">{{__('send Email')}}</button>
                        <a href="{{route('login')}}" class="btn btn-primary mt-4">{{__('Return')}}</a>

                    </div>
                </form>
                </div>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>
@endsection
@section('script')

@if (session('success'))
    <script >
       
        var success = @json(session()->pull("success"));
        console.log(success)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title:success,
                showConfirmButton: false,
                timer: 1500
            })
        
    </script>
@endif
@endsection