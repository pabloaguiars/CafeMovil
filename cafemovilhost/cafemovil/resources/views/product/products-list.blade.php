@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($user_type == 2)
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
                                    <label for="{{ $product->id_at_store }}" class="col-form-label text-md-left">
                                        <b>Número de control en la tienda:</b> {{ $product->id_at_store }}
                                        <b>Nombre del producto:</b> {{ $product->name }} <br>
                                        <b>Precio unitario:</b> ${{ $product->unit_price }} MXN.
                                        <b>En inventario:</b> {{ $product->at_inventory }} 
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
                                    
                                    <button type="submit" class="btn btn-primary" onclick="whatProduct(event,1)">
                                        {{ __('Detalles') }}
                                    </button>
                                </div>

                                <div class="col-md-4 offset-md-1">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatProduct(event,2)">
                                        {{ __('Habilitar') }}
                                    </button>
                                </div>

                                <div class="col-md-4 offset-md-1">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatProduct(event,3)">
                                        {{ __('Inhabilitar') }}
                                    </button>
                                </div>

                                <div class="col-md-4 offset-md-1">
                                    
                                    <button type="submit" class="btn btn-warning" onclick="whatProduct(event,4)">
                                        {{ __('Editar') }}
                                    </button>
                                </div>


                                <script>
                                        function whatProduct(e,x) {
                                            //e.preventDefault();
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
                                            }
                                        }
                                    </script>
                            </div>
                        </form>
                    </div>
                @elseif($user_type == 3)
                    <div class="card-header">¡Selecciona los productos y ordena!</div>

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

                        <form method="POST" action="{{ route('confirm-order') }}" id="form"  enctype="multipart/form-data">
                            @csrf

                            <div class="btn-group">
                                <div class="col-md-6">
                                    
                                    <button type="submit" class="btn btn-success" >
                                        {{ __('Completar orden') }}
                                    </button>
                                </div>

                            </div>
                            <br/>  <br/>
                            @foreach ($products as $product)
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <input id="{{ $product->id }}" type="checkbox" class="form-control @error('$product->id') is-invalid @enderror" name="products[]" value="{{ $product->id }}">
                                        @error('$product->id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="{{ $product->id }}" class="col-form-label text-md-left">
                                        <img src="{{ asset('storage/'.$product->image_url) }}" alt="{{  $product->image_url }}" class="img-fluid img-thumbnail" style="" /> <br>
                                        <b>Nombre del producto:</b> {{ $product->name }}
                                        <b>Precio unitario:</b> ${{ $product->unit_price }} MXN.
                                    </label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection