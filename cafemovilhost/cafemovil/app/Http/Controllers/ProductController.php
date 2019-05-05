<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Products;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
