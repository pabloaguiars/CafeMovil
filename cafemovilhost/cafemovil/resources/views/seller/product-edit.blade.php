@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edita los datos del producto') }}</div>

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

                    <form method="POST" action="" id="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="id_at_store" class="col-md-4 col-form-label text-md-right">{{ __('Número de control en la tienda') }}</label>

                            <div class="col-md-6">
                                <input id="id_at_store" type="text" class="form-control @error('id_at_store') is-invalid @enderror" name="id_at_store" value="{{ old('id_at_store', $id_at_store)  }}" required autocomplete="name" autofocus>

                                @error('id_at_store')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del producto') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $name)  }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Precio unitario [MXN]') }}</label>

                            <div class="col-md-6">
                                <input id="unit_price" type="number" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" value="{{ old('unit_price',$unit_price) }}" autofocus min="0" max="255" step="0.01" required>

                                @error('unit_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="name" autofocus maxlength="140" rows="4"  style="resize:none" placeholder="Describe en 140 caracteres.">{{ old('description',$description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Foto del producto') }}</label>

                            <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="name" autofocus>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                        <input id = "update_type" name="update_type" type="hidden" value="all">
                        <input id = "_id_at_store" name="_id_at_store" type="hidden" value="{{ $id_at_store }}">
                        <input id = "_method" name="_method" type="hidden" value="">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning" onclick="whatSeller(event)">
                                    {{ __('Actualizar') }}
                                </button>
                                <script>
                                    function whatSeller(e) {
                                        //e.preventDefault();
                                        var _url = '';
                                        var _method = '';
        
                                        //update for enable
                                        _url = '/products/' + document.getElementById('_id_at_store').value;
                                        _method = 'PUT';
                                        
                                        var frm = document.getElementById('form') || null;
                                        if(frm) {
                                            
                                            document.getElementById('_method').value = _method;
                                            frm.action = _url;                         
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
