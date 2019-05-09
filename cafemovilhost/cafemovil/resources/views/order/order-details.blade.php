@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalles de la orden') }}</div>

                <div class="card-body">
                    <form method="POST" action="" id="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="id_order" class="col-md-4 col-form-label text-md-right">{{ __('Número de control de la orden: ') }}</label>

                            <div class="col-md-6">
                                <label for="id_order" class="col-form-label">{{ $id_order }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre: ') }}</label>

                            <div class="col-md-6">
                                <label for="name" class="col-form-label">{{ $client_name }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="client_id_at_school" class="col-md-4 col-form-label text-md-right">{{ __('Número de control del cliente: ') }}</label>

                            <div class="col-md-6">
                                <label for="client_id_at_school" class="col-form-label">{{ $client_id_at_school }}</label>
                            </div>
                        </div>

                        <!-- products -->
                        @foreach($order_details as $order_detail)
                            @foreach($products as $product)
                                @if($order_detail->id_product == $product->id)
                                    <div class="form-group row">
                                        <label for="{{ $product->id }}" class="col-md-4 col-form-label text-md-right">{{ __('Producto: ') }}</label>

                                        <div class="col-md-6">
                                            <label for="{{ $product->id }}" class="col-form-label">{{ $product->name.' ['.$product->id_at_store.']' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="{{$product->id}}" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad: ') }}</label>

                                        <div class="col-md-6">
                                            <label for="{{$product->id}}" class="col-form-label">{{ $order_detail->quantity }}</label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach

                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">{{ __('Total [MXN]: ') }}</label>

                            <div class="col-md-6">
                                <label for="total" class="col-form-label">${{ $total }} MXN</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Estatus de la orden: ') }}</label>

                            <div class="col-md-6">
                                <label for="status" class="col-form-label">
                                    @if($status == 2) 
                                        {{ __('Entregado') }}
                                    @else
                                        {{ __('Por entregar') }}
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

                        <div class="form-group row">
                            <label for="deliver_at" class="col-md-4 col-form-label text-md-right">{{ __('Entregar el: ') }}</label>

                            <div class="col-md-6">
                                <label for="deliver_at" class="col-form-label">
                                    {{ $deliver_at }}
                                </label>
                            </div>
                        </div>

                        <div class="btn-group">
                            <input id = "_method" name="_method" type="hidden" value="">
                            <input id = "id_order" name="id_order" type="hidden" value="{{ $id_order }}">
                            <input id = "update_type" name="update_type" type="hidden" value="deliver">

                            @if($status == 2) 
                            <div class="col-md-4 offset-md-5">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                        {{ __('Marcar como no entregada') }}
                                    </button>
                                </div>
                            @else
                            <div class="col-md-4 offset-md-5">
                                    
                                    <button type="submit" class="btn btn-danger" onclick="whatSeller(event,2)">
                                        {{ __('Marcar como entregada') }}
                                    </button>
                                </div>
                            @endif

                            <script>
                                    function whatSeller(e,x) {
                                        //e.preventDefault();
                                        var _url = '';
                                        var _method = '';
                                        if (x == 2) {
                                            //update for deliver
                                            _url = '/orders/' + document.getElementById('id_order').value;
                                            _method = 'PUT';
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
