@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($user_type == 2)
                    <div class="card-header">Ordenes por atender</div>

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

                            @foreach ($orders as $order)
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <input id="{{ $order->id }}" type="radio" class="form-control @error('required') is-invalid @enderror" name="orders" value="{{ $order->id }}" checked>
                                        @error('required')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="{{ $order->id }}" class="col-form-label text-md-left">
                                        <b>Número de orden:</b> {{ $order->id }}
                                        <b>Cliente:</b> {{ $order->id_client }}
                                        <b>Estatus:</b> @if($order->status == 1) 
                                                            {{ __('Entregado') }}
                                                        @else
                                                            {{ __('Por entregar') }}
                                                        @endif <br>
                                        <b>Creada el:</b> {{ $order->created_at }}
                                        <b>Entregar el:</b> {{ $order->deliver_at }}
                                        
                                    </label>
                                </div>
                            @endforeach

                            <div class="btn-group">
                                <input id = "_method" name="_method" type="hidden" value="">
                                <input id = "update_type" name="update_type" type="hidden" value="deliver">
                                
                                <div class="col-md-4 offset-md-5">
                                    
                                    <button type="submit" class="btn btn-primary" onclick="whatSeller(event,1)">
                                        {{ __('Detalles') }}
                                    </button>
                                </div>

                                <div class="col-md-4 offset-md-5">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                        {{ __('Marcar como entregada') }}
                                    </button>
                                </div>

                                <script>
                                        function whatSeller(e,x) {
                                            var _url = '';
                                            var _method = '';
                                            if (x == 1) {
                                                //show
                                                _url = '/orders/' + $('input[name=orders]:checked').val();
                                                _method = 'GET';
                                            } else if (x == 2) {
                                                //update for deliver
                                                _url = '/orders/' + $('input[name=orders]:checked').val();
                                                _method = 'PUT';
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
                @elseif($user_type == 3)
                    
                @endif
            </div>
        </div>
    </div>
</div>
@endsection