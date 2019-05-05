@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalles del producto') }}</div>

                <div class="card-body">
                    <form method="POST" action="" id="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="id_at_store" class="col-md-4 col-form-label text-md-right">{{ __('Número de control en la tienda: ') }}</label>

                            <div class="col-md-6">
                                <label for="id_at_store" class="col-form-label">{{ $id_at_store }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre: ') }}</label>

                            <div class="col-md-6">
                                <label for="name" class="col-form-label">{{ $name }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Precio unitario [MXN]: ') }}</label>

                            <div class="col-md-6">
                                <label for="unit_price" class="col-form-label">${{ $unit_price }} MXN</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción ') }}</label>

                            <div class="col-md-6">
                                <label for="description" class="col-form-label">{{ $description }}</label>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Estatus del producto: ') }}</label>

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
                            <input id = "id_at_store" name="id_at_store" type="hidden" value="{{ $id_at_store }}">
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
                                            _url = '/products/' + document.getElementById('id_at_store').value;
                                            _method = 'GET';
                                        } else if (x == 2) {
                                            //update for enable
                                            _url = '/products/' + document.getElementById('id_at_store').value;
                                            _method = 'PUT';
                                        } else if (x == 3) {
                                            //destroy
                                            _url = '/products/' + document.getElementById('id_at_store').value;
                                            _method = 'DELETE';
                                        } else if (x == 4) {
                                            //edit
                                            _url = '/products/' + document.getElementById('id_at_store').value + '/edit';
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
