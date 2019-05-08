@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">Completa tu orden</div>

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

                        <form method="POST" action="{{ route('orders.store') }}" id="form"  enctype="multipart/form-data">
                            @csrf

                            @foreach ($pre_order_details as $product)
                                <div class="form-group row">
                                    <label for="$product->name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del producto') }}</label>

                                    <div class="col-md-6">
                                        <input id="$product->name" type="text" class="form-control @error('$product->name') is-invalid @enderror" name="$product->name" value="{{ old($product->name,$product->name) }}" required autocomplete="name" autofocus readonly>

                                        @error('$product->name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="$product->unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Precio unitario [MXN]') }}</label>

                                    <div class="col-md-6">
                                        <input id="$product->unit_price" type="number" class="form-control @error('$product->unit_price') is-invalid @enderror" name="$product->unit_price" value="{{ old($product->unit_price,$product->unit_price) }}" autofocus min="0" max="255" step="0.01" readonly required>

                                        @error('$product->unit_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="$product->description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="$product->description" class="form-control @error('$product->description') is-invalid @enderror" name="$product->description" required readonly autocomplete="name" autofocus maxlength="140" rows="4"  style="resize:none" placeholder="Describe en 140 caracteres.">{{ old($product->description,$product->description) }}</textarea>

                                        @error('$product->description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>

                                    <div class="col-md-6">
                                        <input id="products" type="hidden" name="products[]" value="{{ $product->id }}" required>
                                        <input id="sellers" type="hidden" name="sellers[]" value="{{ $product->id_seller }}" required>
                                        <input id="quantities" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantities[]" value="{{ old('quantity',1) }}" autofocus min="1" step="1" required>

                                        @error('quantities')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            @endforeach

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Elige fecha de entrega') }}</label>

                                <div class="col-md-6">
                                    <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror"  value="{{ old('date') }}" required>
                                </div>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Elige fecha de entrega') }}</label>

                                <div class="col-md-6">
                                    <input id="time" name="time" type="time" class="form-control @error('time') is-invalid @enderror"  value="{{ old('time') }}" min="06:00" max="20:00" required>
                                </div>

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="btn-group">
                                <input id = "_method" name="_method" type="hidden" value="">
                                <div class="col-md-6 offset-md-2">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                        {{ __('Cancelar') }}
                                    </button>
                                </div>

                                <div class="col-md-6 offset-md-2">
                                    
                                    <button type="submit" class="btn btn-primary" onclick="whatSeller(event,3)">
                                        {{ __('Regresar') }}
                                    </button>
                                </div>

                                <div class="col-md-6 offset-md-2">
                                    
                                    <button type="submit" class="btn btn-success" onclick="whatSeller(event,1)">
                                        {{ __('Ordenar') }}
                                    </button>
                                </div>

                                <script>
                                    function whatSeller(e,x) {
                                            var _url = '';
                                            var _method = '';
                                            if (x == 1) {
                                                //store
                                                _url = '/orders';
                                                _method = 'POST';
                                            } else if (x == 2) {
                                                //discard
                                                window.location.href = "../home";
                                            } else if (x == 3) {
                                                //modify
                                                window.history.back();
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