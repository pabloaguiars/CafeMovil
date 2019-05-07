<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = \Auth::id();
        $user = User::select('email','id_user_type')->where('id', $id)->first();

        $activities = array();
        //array_push($activities,array('#','text'));
        if($user->id_user_type === 1){
            array_push($activities,array('0','#','Reporte/Ventas'));
            array_push($activities,array('0','#','Reporte/Servicio'));
            array_push($activities,array('0','sellers.create','Vendedores/Alta'));
            array_push($activities,array('0','sellers.index','Vendedores/Lista'));
            #show seller by email
            array_push($activities,array('1','seller-choose-by-email','Vendedores/Ver','1'));
            #enable seller by email
            array_push($activities,array('1','seller-choose-by-email','Vendedores/Habilitar','2'));
            #disable seller by email
            array_push($activities,array('1','seller-choose-by-email','Vendedores/Inhabilitar','3'));
            #edit seller by email
            array_push($activities,array('1','seller-choose-by-email','Vendedores/Editar','4'));
        } else if($user->id_user_type === 2){
            array_push($activities,array('0','#','Reporte/Ventas'));
            array_push($activities,array('0','#','Reporte/Servicio'));
            array_push($activities,array('0','orders.index','Pedidos/Consulta'));
            array_push($activities,array('0','products.create','Productos/Alta'));
            array_push($activities,array('0','products.index','Productos/Lista'));
            #show product by id at store
            array_push($activities,array('1','product-choose-by-id-at-store','Productos/Ver','1'));
            #enable product by id at store
            array_push($activities,array('1','product-choose-by-id-at-store','Productos/Habilitar','2'));
            #disable product by id at store
            array_push($activities,array('1','product-choose-by-id-at-store','Productos/Baja','3'));
            #edit product by id at store
            array_push($activities,array('1','product-choose-by-id-at-store','Productos/Modificación','4'));
        }  else if($user->id_user_type === 3){
            array_push($activities,array('0','#','Pedidos/Alta'));
            array_push($activities,array('0','products.index','Productos/Consulta'));
            array_push($activities,array('0','#','Estadística/Más barato'));
            array_push($activities,array('0','#','Estadística/Más vendido'));
        }

        return view('home',['activities' => $activities]);
    }
}
