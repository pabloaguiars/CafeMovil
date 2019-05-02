<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\School;
use App\Seller;
use App\UserOwn;
use App\User;

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
        return view('school-administrator.sellers-list',['sellers' => Seller::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('school-administrator.seller-register',['schools' => School::all()]);
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

        try {
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
            $user->status = true;
            $user->save();

            return redirect()->route('home')->with('status', '¡Vendedor '.$user->email.' creado con éxito!');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('home')->with('failure', '!ERROR! Algo salió mal.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        //
        $seller = DB::table('sellers')->select()->where('email',$email)->first();
        if($seller){
            $user = DB::table('users')->select()->where('email',$seller->email)->first();
            $school = DB::table('schools')->select()->where('id',$seller->id_school)->first();
            #show seller
            return view('school-administrator.seller-details',[
                'name' => $seller->name,
                'father_last_name' => $seller->father_last_name,
                'mother_last_name' => $seller->father_last_name,
                'phone' => $seller->phone,
                'curp' => $seller->curp,
                'school' => $school->name,
                'id_at_school' => $seller->id_at_school,
                'email' => $seller->email,
                'status' => $user->status,
                'created' => $seller->created_at,
                'updated' => $seller->updated_at
            ]);
        } else {
            return redirect()->back()->with('failure', '¡Vendedor '.$email.' no registrado!')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function edit($email)
    {
        //
        $seller = DB::table('sellers')->select()->where('email',$email)->first();
        if($seller){
            $user = DB::table('users')->select()->where('email',$seller->email)->first();

            return view('school-administrator.seller-edit',[
                'name' => $seller->name,
                'father_last_name' => $seller->father_last_name,
                'mother_last_name' => $seller->father_last_name,
                'phone' => $seller->phone,
                'curp' => $seller->curp,
                'id_at_school' => $seller->id_at_school,
                'email' => $seller->email,
                'status' => $user->status
            ]);
        } else {
            return redirect()->back()->with('failure', '¡Vendedor '.$email.' no registrado!')->withInput();
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        //
        if($request->update_type == 'enable')
        {
            #enable user
            $seller = DB::table('sellers')->select()->where('email',$email)->first();
            if($seller){
                $user = DB::table('users')->select()->where('email',$seller->email)->first();
                if ($user->status == false) {
                    DB::table('users')->where('id', $user->id)->update(['status' => true]);
                    return redirect()->route('home')->with('status', '¡Vendedor '.$user->email.' habilitado!');
                } else {
                    return redirect()->back()->with('status', '¡Vendedor '.$user->email.' ya estaba habilitado!');
                }
            } else {
                return redirect()->back()->with('failure', '¡Vendedor '.$email.' no registrado!')->withInput();
            }
        } else if ($request->update_type == 'all') {
            #update user info
            $seller = DB::table('sellers')->select()->where('email',$email)->first();
            if($seller){

                $user = DB::table('users')->select()->where('email',$seller->email)->first();

                if ($request->hasFile('image')) {
                    if($seller->image_url != 'profile-images/user-default.png'){
                        Storage::delete($seller->image_url);
                    } 
                    $image = $request['image'];
                    $path = $image->store('profile-images');
                } else {
                    $path = 'profile-images/user-default.png';
                }

                DB::table('sellers')->where('id', $seller->id)->update([
                    'name' => $request['name'],
                    'father_last_name' => $request['father_last_name'],
                    'mother_last_name' => $request['father_last_name'],
                    'phone' => $request['phone'],
                    'image_url' => $path,
                    'curp' => $request['curp'],
                    'id_at_school' => $request['id_at_school'],
                    'email' => $request['email']
                ]);

                DB::table('users')->where('id', $user->id)->update([
                    'email' => $request['email']
                ]);

                return redirect()->route('home')->with('status', '¡Vendedor '.$request->email.' editado con éxito!');
            } else {
                return redirect()->back()->with('failure', '¡Vendedor '.$email.' no registrado!')->withInput();
            }
        } else {
            return redirect()->route('home')->with('failure', '¡Opción no válida!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        //
        $seller = DB::table('sellers')->select()->where('email',$email)->first();
        if($seller){
            $user = DB::table('users')->select()->where('email',$seller->email)->first();
            if ($user->status == true) {
                DB::table('users')->where('id', $user->id)->update(['status' => false]);
                return redirect()->route('home')->with('status', '¡Vendedor '.$user->email.' deshabilitado!');
            } else {
                return redirect()->back()->with('status', '¡Vendedor '.$user->email.' ya estaba deshabilitado!')->withInput();
            }
        } else {
            return redirect()->back()->with('failure', '¡Vendedor '.$email.' no registrado!')->withInput();
        }
        
        
    }
}
