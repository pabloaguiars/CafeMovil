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
            array_push($activities,array('#','Reporte/Ventas'));
            array_push($activities,array('#','Reporte/Servicio'));
            array_push($activities,array('#','Pedidos/Consulta'));
            array_push($activities,array('#','Menú/Alta'));
            array_push($activities,array('#','Menú/Baja'));
            array_push($activities,array('#','Menú/Modificación'));
        }  else if($user->id_user_type === 3){
            array_push($activities,array('#','Pedidos/Alta'));
            array_push($activities,array('#','Menú/Consulta'));
            array_push($activities,array('#','Estadística/Más barato'));
            array_push($activities,array('#','Estadística/Más vendido'));
        }

        return view('home',['activities' => $activities]);
    }
}
