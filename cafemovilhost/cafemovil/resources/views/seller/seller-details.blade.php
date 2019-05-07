@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalles del vendedor') }}</div>

                <div class="card-body">
                    <form method="POST" action="" id="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre: ') }}</label>

                            <div class="col-md-6">
                                <label for="name" class="col-form-label">{{ $name.' '.$father_last_name.' '.$mother_last_name }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="curp" class="col-md-4 col-form-label text-md-right">{{ __('CURP: ') }}</label>

                            <div class="col-md-6">
                                <label for="curp" class="col-form-label">{{ $curp }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono personal: ') }}</label>

                            <div class="col-md-6">
                                <label for="phone" class="col-form-label">{{ $phone }}</label>

                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="id_school" class="col-md-4 col-form-label text-md-right">{{ __('Escuela: ') }}</label>

                            <div class="col-md-6">
                                <label for="id_school" class="col-form-label">{{ $school }}</label>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_at_school" class="col-md-4 col-form-label text-md-right">{{ __('Número de control escolar: ') }}</label>

                            <div class="col-md-6">
                                <label for="id_at_school" class="col-form-label">{{ $id_at_school }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico: ') }}</label>

                            <div class="col-md-6">
                                <label for="email" class="col-form-label">{{ $email }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Estatus del usuario: ') }}</label>

                            <div class="col-md-6">
                                <label for="status" class="col-form-label">
                                    @if($status == 1) 
                                        {{ __('Habilitado') }}
                                    @else
                                        {{ __('Inhabilitado') }}
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Creado en: ') }}</label>

                            <div class="col-md-6">
                                <label for="created_at" class="col-form-label">
                                    {{ $created_at }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="updated_at" class="col-md-4 col-form-label text-md-right">{{ __('Actualizado en: ') }}</label>

                            <div class="col-md-6">
                                <label for="updated_at" class="col-form-label">
                                    {{ $updated_at }}
                                </label>
                            </div>
                        </div>

                        <div class="btn-group">
                            <input id = "_method" name="_method" type="hidden" value="">
                            <input id = "email" name="email" type="hidden" value="{{ $email }}">
                            <input id = "update_type" name="update_type" type="hidden" value="enable">

                            @if($status == 1) 
                                <div class="col-md-6 offset-md-10">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,3)">
                                        {{ __('Inhabilitar') }}
                                    </button>
                                </div>
                            @else
                                <div class="col-md-6 offset-md-10">
                            
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                        {{ __('Habilitar') }}
                                    </button>
                                </div>
                            @endif

                            <div class="col-md-6 offset-md-9">
                                
                                <button type="submit" class="btn btn-warning" onclick="whatSeller(event,4)">
                                    {{ __('Editar') }}
                                </button>
                            </div>


                            <script>
                                    function whatSeller(e,x) {
                                        //e.preventDefault();
                                        var _url = '';
                                        var _method = '';
                                        if (x == 1) {
                                            //show
                                            _url = '/sellers/' + document.getElementById('email').value;
                                            _method = 'GET';
                                        } else if (x == 2) {
                                            //update for enable
                                            _url = '/sellers/' + document.getElementById('email').value;
                                            _method = 'PUT';
                                        } else if (x == 3) {
                                            //destroy
                                            _url = '/sellers/' + document.getElementById('email').value;
                                            _method = 'DELETE';
                                        } else if (x == 4) {
                                            //edit
                                            _url = '/sellers/' + document.getElementById('email').value + '/edit';
                                            _method = 'GET';
                                        }

                                        var frm = document.getElementById('form') || null;
                                        if(frm) {
                                            
                                            document.getElementById('_method').value = _method;
                                            frm.action = _url;                                             
                                        }
                                    }
                                </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
