@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Productos en la tienda</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br/>

                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif

                    <form method="POST" action="" id="form"  enctype="multipart/form-data">
                        @csrf

                        @foreach ($products as $product)
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <input id="{{ $product->id_at_store }}" type="radio" class="form-control @error('required') is-invalid @enderror" name="products" value="{{ $product->id_at_store }}" checked>
                                    @error('required')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="{{ $product->id }}" class="col-form-label text-md-left">
                                    <b>Número de control en la tienda:</b> {{ $product->id_at_store }}
                                    <b>Nombre del producto:</b> {{ $product->name }} <br>
                                    <b>Precio unitario:</b> ${{ $product->unit_price }} MXN.
                                    <b>Estatus:</b> @if($product->status == 1) 
                                                        {{ __('Habilitado') }}
                                                    @else
                                                        {{ __('Inhabilitado') }}
                                                    @endif
                                </label>
                            </div>
                        @endforeach

                        <div class="btn-group">
                            <input id = "_method" name="_method" type="hidden" value="">
                            <input id = "update_type" name="update_type" type="hidden" value="enable">
                            <div class="col-md-4 offset-md-1">
                                
                                <button type="submit" class="btn btn-primary" onclick="whatSeller(event,1)">
                                    {{ __('Detalles') }}
                                </button>
                            </div>

                            <div class="col-md-4 offset-md-1">
                                
                                <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                    {{ __('Habilitar') }}
                                </button>
                            </div>

                            <div class="col-md-4 offset-md-1">
                                
                                <button type="submit" class="btn btn-danger" onclick="whatSeller(event,3)">
                                    {{ __('Inhabilitar') }}
                                </button>
                            </div>

                            <div class="col-md-4 offset-md-1">
                                
                                <button type="submit" class="btn btn-warning" onclick="whatSeller(event,4)">
                                    {{ __('Editar') }}
                                </button>
                            </div>


                            <script>
                                    function whatSeller(e,x) {
                                        var _url = '';
                                        var _method = '';
                                        if (x == 1) {
                                            //show
                                            _url = '/products/' + $('input[name=products]:checked').val();
                                            _method = 'GET';
                                        } else if (x == 2) {
                                            //update for enable
                                            _url = '/products/' + $('input[name=products]:checked').val();
                                            _method = 'PUT';
                                        } else if (x == 3) {
                                            //destroy
                                            _url = '/products/' + $('input[name=products]:checked').val();
                                            _method = 'DELETE';
                                        } else if (x == 4) {
                                            //edit
                                            _url = '/products/' + $('input[name=products]:checked').val() + '/edit';
                                            _method = 'GET';
                                        }

                                        var frm = document.getElementById('form') || null;
                                        if(frm) {
                                            
                                            document.getElementById('_method').value = _method;
                                            frm.action = _url; 
                                            //e.preventDefault();
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