<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use App\Order;
use App\OrderDetails;

class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $email = Auth::user()->email;
        $user = DB::table('users')->select()->where('email',$email)->first();
        if ($user->id_user_type == 1) {
            //school administrator

        } else if ($user->id_user_type == 2) {
            //seller
            $seller = DB::table('sellers')->select()->where('email',$email)->first();
            $orders_details = DB::table('orders_details')->select()->where('id_seller',$seller->id)->get();
            $orders = collect([]);
            foreach ($orders_details as $order_detail) {
                $order = DB::table('orders')->select()->where('id',$order_detail->id_order)->first();
                if (($order->status == false) and ($orders->contains('id',$order->id) == false)) {
                    $orders->prepend($order);
                }
            }
            return view('order.orders-list',['user_type' => $user->id_user_type, 'orders' => $orders]);
        } else if ($user->id_user_type == 3) {
            //student
            
        } else {
            return redirect()->route('home')->with('failure', '¡Opción no válida!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        //
        $data = $request->validate([
            'products' => ['required','min:1']
        ]);
        
        $pre_order_details = collect([]);
        foreach ($data['products'] as $product_id) {
            $product = DB::table('products')->select()->where('id',$product_id)->first();
            $pre_order_details->prepend($product);
        }

        return view('order.confirm-order',['pre_order_details' => $pre_order_details]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datetime = $request['date'].' '.$request['time'];
        $now = Carbon::now();
        if ($now->lessThan($datetime)) {
            $data = $request->validate([
                'products' => ['required','min:1'],
                'quantities' => ['required','min:1'],
                'sellers' => ['required','min:1']
            ]);
            
            if (count($data['products']) === count($data['quantities'])) {
                $c = 0;
                $total = 0;
                $products = collect([]);
                while ($c < count($data['products'])) {
                    $quantity = $data['quantities'][$c];
                    $product = DB::table('products')->select()->where('id',$data['products'][$c])->first();
                    if ($product->at_inventory >= $quantity) {
                        $total = $total + ($product->unit_price * $quantity);
                        DB::table('products')->where('id',$product->id)->update(['at_inventory' => ($product->at_inventory - $quantity),'updated_at' => Carbon::now()]);
                        $products->prepend($product);
                        $c = $c + 1;
                    } else {
                        return redirect()->route('home')->with('failure', '¡Solamente existen '.$product->at_inventory.' unidades del producto '.$product->name.' en inventario!');
                    }
                }
                $email = Auth::user()->email;
                $student = DB::table('students')->select()->where('email',$email)->first();

                $order = new Order;
                $order->id_client = $student->id;
                $order->total = $total;
                $order->status = false;
                $order->deliver_at = $datetime;

                $order->save();
                
                foreach ($products as $product) {
                    $order_details = new OrderDetails;
                    $order_details->id_order = $order->id;
                    $order_details->id_product = $product->id;
                    $c = 0;
                    while ($c < count($data['products'])) {
                        if ($data['products'][$c] == $product->id) {
                            $order_details->id_seller = $data['sellers'][$c];
                            $order_details->quantity = $data['quantities'][$c];
                        }
                        $c = $c + 1;
                    }
                    $order_details->save();
                }
                return redirect()->route('home')->with('status', '¡Orden generada exitosamente!');
            } else {
                return redirect()->route('home')->with('failure', '¡ERROR: Intente de nuevo!');
            }
        } else {
            return redirect()->route('home')->with('failure', '¡Ingresaste una fecha y/o fecha inválida!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_order
     * @return \Illuminate\Http\Response
     */
    public function show($id_order)
    {
        //
        $order = DB::table('orders')->select()->where('id',$id_order)->first();
        if ($order) {
            $client = DB::table('students')->select()->where('id',$order->id_client)->first();
            $order_details = DB::table('orders_details')->select()->where('id_order',$order->id)->get();
            $products = collect([]);
            foreach ($order_details as $order_detail) {
                $product = DB::table('products')->select()->where('id',$order_detail->id_product)->first();
                $products->prepend($product);
            }
            return view('order.order-details',[
                'id_order' => $order->id,
                'client_name' => $client->name.' '.$client->father_last_name.' '.$client->mother_last_name,
                'client_id_at_school' => $client->id_at_school,
                'order_details' => $order_details,
                'products' => $products,
                'total' => $order->total,
                'status' => $order->status,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'deliver_at' => $order->deliver_at
            ]);
        } else {
            return redirect()->back()->with('failure', '¡Orden '.$id_order.' no encontrada!')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        dd("edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_order)
    {
        //
        if($request->update_type == 'deliver')
        {
            $order = DB::table('orders')->select()->where('id',$id_order)->first();
            if ($order) {
                if ($order->status == false) {
                    DB::table('orders')->where('id',$id_order)->update(['status' => true,'updated_at' => Carbon::now(),'delivered_at' => Carbon::now()]);
                    return redirect()->route('home')->with('status', '¡Orden '.$order->id.' marcada como entregada!');
                } else {
                    return redirect()->back()->with('status', '¡Orden '.$order->id.' ya estaba marcada como entregada!')->withInput();
                }
            } else {
                return redirect()->back()->with('failure', '¡Orden '.$id_order.' no encontrada!')->withInput();
            }
        } else if ($request->update_type == 'all') {
            # code...
            dd("all");
        } else {
            return redirect()->route('home')->with('failure', '¡Opción no válida!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        dd("destroy");
    }
}
