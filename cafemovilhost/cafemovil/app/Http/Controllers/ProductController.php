<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Product;
use App\Seller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('seller.products-list',['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('seller.product-register');
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
        $data = $request->validate([
            'id_at_store' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric', 'min:0', 'max:255', 'regex:/^[0-9]+\.[0-9]{2}$/'],
            'description' => ['required', 'string', 'max:140'],
            'image' => ['required','mimes:jpeg,jpg,png','required','max:10000']
        ]);

        $email = Auth::user()->email;
        $seller = DB::table('sellers')->select()->where('email',$email)->first();

        $product = new Product;
        $product->id_at_store = $data['id_at_store'];
        $product->name = $data['name'];
        $product->unit_price = $data['unit_price'];
        $product->description = $data['description'];
        $product->status = true;
        $product->id_seller = $seller->id;

        $image = $data['image'];
        if ($image->isValid('image')) {
            $path = $image->store('products-images');
            $product->image_url = $path;
        }

        $product->save();

        //
        return redirect()->route('home')->with('status', '¡Producto '.$data['name'].' creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_at_store
     * @return \Illuminate\Http\Response
     */
    public function show($id_at_store)
    {
        //
        $email = Auth::user()->email;
        $seller = DB::table('sellers')->select()->where('email',$email)->first();
        $product = DB::table('products')->select()->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->first();
        if($product){
            return view('seller.product-details',[
                'id_at_store' => $product->id_at_store,
                'name' => $product->name,
                'unit_price' => $product->unit_price,
                'description' => $product->description,
                'status' => $product->status,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ]);
        } else {
            return redirect()->back()->with('failure', '¡Producto '.$id_at_store.' no encontrado!')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_at_store
     * @return \Illuminate\Http\Response
     */
    public function edit($id_at_store)
    {
        //
        $email = Auth::user()->email;
        $seller = DB::table('sellers')->select()->where('email',$email)->first();
        $product = DB::table('products')->select()->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->first();
        if($product){
            return view('seller.product-edit',[
                'id_at_store' => $product->id_at_store,
                'name' => $product->name,
                'unit_price' => $product->unit_price,
                'description' => $product->description
            ]);
        } else {
            return redirect()->back()->with('failure', '¡Producto '.$id_at_store.' no encontrado!')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_at_store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_at_store)
    {
        //

        if($request->update_type == 'enable')
        {
            #enable prodruct
            $email = Auth::user()->email;
            $seller = DB::table('sellers')->select()->where('email',$email)->first();
            $product = DB::table('products')->select()->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->first();
            if($product){
                if ($product->status == false) {
                    DB::table('products')->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->update(['status' => true]);
                    return redirect()->route('home')->with('status', '¡Producto '.$product->name.'['.$product->id_at_store.'] habilitado!');
                } else {
                    return redirect()->back()->with('status', '¡Producto '.$product->name.'['.$product->id_at_store.'] ya estaba habilitado!')->withInput();
                }
            } else {
                return redirect()->back()->with('failure', '¡Producto '.$id_at_store.' no encontrado!')->withInput();
            }
        } else if ($request->update_type == 'all') {
            #update product info
            $data = $request->validate([
                'id_at_store' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'unit_price' => ['required', 'numeric', 'min:0', 'max:255', 'regex:/^[0-9]+\.[0-9]{2}$/'],
                'description' => ['required', 'string', 'max:140'],
                'image' => ['mimes:jpeg,jpg,png','max:10000']
            ]);

            $email = Auth::user()->email;
            $seller = DB::table('sellers')->select()->where('email',$email)->first();

            if ($request->hasFile('image')) {
                if($seller->image_url != 'profile-images/user-default.png'){
                    Storage::delete($seller->image_url);
                } 
                $image = $data['image'];
                $path = $image->store('profile-images');
            } else {
                $path = 'profile-images/user-default.png';
            }

            DB::table('products')->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->update([
                'id_at_store' => $data['id_at_store'],
                'name' => $data['name'],
                'unit_price' => $data['unit_price'],
                'description' => $data['description'],
                'image_url' => $path,
            ]);

            return redirect()->route('home')->with('status', '¡Producto '.$data->name.'['.$data->id_at_store.'] editado con éxito!');

        } else {
            return redirect()->route('home')->with('failure', '¡Opción no válida!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_at_store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_at_store)
    {
        //
        $email = Auth::user()->email;
        $seller = DB::table('sellers')->select()->where('email',$email)->first();
        $product = DB::table('products')->select()->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->first();
        if($product){
            if ($product->status == true) {
                DB::table('products')->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->update(['status' => false]);
                return redirect()->route('home')->with('status', '¡Producto '.$product->name.'['.$product->id_at_store.'] deshabilitado!');
            } else {
                return redirect()->back()->with('status', '¡Producto '.$product->name.'['.$product->id_at_store.'] ya estaba deshabilitado!')->withInput();
            }
        } else {
            return redirect()->back()->with('failure', '¡Producto '.$id_at_store.' no encontrado!')->withInput();
        }
    }
}
