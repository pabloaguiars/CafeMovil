<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\School;
use App\Seller;
use App\UserOwn;

class SellerController extends Controller
{

    /**
     * Instantiate a new controller instance.
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('school-administrator.register-seller',['schools' => School::all()]);
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
        $seller = new Seller;
        $seller->id_at_school = $request['id_at_school'];
        $seller->name = $request['name'];
        $seller->father_last_name = $request['father_last_name'];
        $seller->mother_last_name = $request['mother_last_name'];
        $seller->curp = $request['curp'];
        $seller->email = $request['email'];
        $seller->phone = $request['phone'];
        $seller->id_school = $request['id_school'];

        $image = $request['image'];
        if ($image->isValid('image')) {
            $path = $image->store('profile-images');
            $seller->image_url = $path;
        }

        $seller->save();

        //
        $user = new UserOwn;
        $user->email = $request['email'];
        $user->id_user_type = 2;
        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect()->route('home');
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
