@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">¡Ingresa el número de control del producto en tu tienda!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif
                    <br/>

                    <form method="POST" action="" id="form"  enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="id_at_store" class="col-md-4 col-form-label text-md-right">{{ __('Número de control en la tienda') }}</label>

                            <div class="col-md-6">
                                <input id="id_at_store" type="id_at_store" class="form-control @error('id_at_store') is-invalid @enderror" name="id_at_store" value="{{ old('id_at_store') }}" required autocomplete="id_at_store">

                                @error('id_at_store')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <input id = "_method" name="_method" type="hidden" value="">
                            <input id = "update_type" name="update_type" type="hidden" value="enable">

                            @if(app('request')->input('action') == 3) 
                                <div class="col-md-6 offset-md-4">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,3)">
                                        {{ __('Inhabilitar') }}
                                    </button>
                                </div>
                            @elseif (app('request')->input('action') == 2)
                            <div class="col-md-6 offset-md-4">
                            
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                        {{ __('Habilitar') }}
                                    </button>
                                </div>
                            @elseif (app('request')->input('action') == 1)
                                <div class="col-md-6 offset-md-4">
                                
                                        <button type="submit" class="btn btn-primary" onclick="whatSeller(event,1)">
                                            {{ __('Detalles') }}
                                        </button>
                                    </div>
                            @elseif (app('request')->input('action') == 4)

                            <div class="col-md-6 offset-md-4">
                                    
                                    <button type="submit" class="btn btn-warning" onclick="whatSeller(event,4)">
                                        {{ __('Editar') }}
                                    </button>
                                </div>
                            @endif


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