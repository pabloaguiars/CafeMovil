<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Product;
use App\Seller;
use Carbon\Carbon;
use Storage;
use App\ProductType;

class ProductController extends Controller
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
            return view('product.products-list',['user_type' => $user->id_user_type, 'products' => Product::all()->where('id_seller',$seller->id)]);
        } else if ($user->id_user_type == 3) {
            //student
            return view('product.products-list',['user_type' => $user->id_user_type,'products' => Product::all()->where('status',true)->where('at_inventory','>',0)]);
        } else {
            return redirect()->route('home')->with('failure', '¡Opción no válida!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.product-register',['products_types' => ProductType::all()]);
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
            'unit_price' => ['required', 'numeric', 'min:0', 'max:255', 'regex:/^[0-9]+\.[0-9]{0,4}$/'],
            'description' => ['required', 'string', 'max:140'],
            'image' => ['required','mimes:jpeg,jpg,png','required','max:10000'],
            'at_inventory' => ['required','int','min:0','regex:/^[0-9]+$/'],
            'id_product_type' => ['required','int']
        ]);

        $email = Auth::user()->email;
        $seller = DB::table('sellers')->select()->where('email',$email)->first();

        $product = new Product;
        $product->id_at_store = $data['id_at_store'];
        $product->name = $data['name'];
        $product->unit_price = $data['unit_price'];
        $product->at_inventory = $data['at_inventory'];
        $product->id_product_type = $data['id_product_type'];
        $product->description = $data['description'];
        $product->status = true;
        $product->id_seller = $seller->id;

        $image = $data['image'];
        if ($image->isValid('image')) {
            $path = Storage::putFile('public/products-images', $image, 'public');
            $path = substr($path,7);
            $image = Image::make(storage_path('app/public/'.$path))->resize(550, 350)->save(storage_path('app/public/'.$path));
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
            $product_type = DB::table('products_types')->select()->where('id',$product->id_product_type)->first();
            return view('product.product-details',[
                'id_at_store' => $product->id_at_store,
                'name' => $product->name,
                'unit_price' => $product->unit_price,
                'at_inventory' => $product->at_inventory,
                'product_type' => $product_type->description,
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
            return view('product.product-edit',[
                'id_at_store' => $product->id_at_store,
                'name' => $product->name,
                'unit_price' => $product->unit_price,
                'at_inventory' => $product->at_inventory,
                'description' => $product->description,
                'id_product_type_current' => $product->id_product_type,
                'products_types' => ProductType::all()
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
                    DB::table('products')->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->update(['status' => true,'updated_at' => Carbon::now()]);
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
                'unit_price' => ['required', 'numeric', 'min:0', 'max:255', 'regex:/^[0-9]+\.[0-9]{0,4}$/'],                'description' => ['required', 'string', 'max:140'],
                'image' => ['mimes:jpeg,jpg,png','max:10000'],
                'at_inventory' => ['required','int','min:0','regex:/^[0-9]+$/'],
                'id_product_type' => ['required','int']
            ]);

            $email = Auth::user()->email;
            $seller = DB::table('sellers')->select()->where('email',$email)->first();
            $product = DB::table('products')->select()->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->first();

            if ($request->hasFile('image')) {
                if($product->image_url != 'products-images/product-default.png'){
                    Storage::delete('public/'.$product->image_url);
                } 
                $image = $request['image'];
                
                $path = Storage::putFile('public/products-images', $image, 'public');
                $path = substr($path,7);
                $image = Image::make(storage_path('app/public/'.$path))->resize(550, 350)->save(storage_path('app/public/'.$path));
            } else {
                $path = $product->image_url;
            }

            DB::table('products')->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->update([
                'id_at_store' => $data['id_at_store'],
                'name' => $data['name'],
                'unit_price' => $data['unit_price'],
                'at_inventory' => $data['at_inventory'],
                'description' => $data['description'],
                'image_url' => $path,
                'id_product_type' => $data['id_product_type'],
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('home')->with('status', '¡Producto '.$data['name'].' ['.$data['id_at_store'].'] editado con éxito!');

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
                DB::table('products')->where('id_seller',$seller->id)->where('id_at_store',$id_at_store)->update(['status' => false,'updated_at' => Carbon::now()]);
                return redirect()->route('home')->with('status', '¡Producto '.$product->name.'['.$product->id_at_store.'] deshabilitado!');
            } else {
                return redirect()->back()->with('status', '¡Producto '.$product->name.'['.$product->id_at_store.'] ya estaba deshabilitado!')->withInput();
            }
        } else {
            return redirect()->back()->with('failure', '¡Producto '.$id_at_store.' no encontrado!')->withInput();
        }
    }
}
