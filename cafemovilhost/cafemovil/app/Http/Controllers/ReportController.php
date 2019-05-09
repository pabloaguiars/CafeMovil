<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reports\ReportSellersSales;
use App\Reports\ReportSellersService;
use App\Reports\ReportSellerSales;
use App\Reports\ReportSellerService;
use App\Reports\ReportMostSalledProducts;
use App\Reports\ReportUnitPriceSalesProducts;
use Auth;
use DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $report
     * @return \Illuminate\Http\Response
     */
    public function show($report)
    {
        $email = Auth::user()->email;
        $user = DB::table('users')->select()->where('email',$email)->first();

        if ($user->id_user_type == 1) {
            //school administrator
            if ($report == 1) {
                //sellers sales report
                $school_administrator = DB::table('schools_administrators')->select()->where('email',$email)->first();
                $report = new ReportSellersSales(array("id_school"=>$school_administrator->id_school));
                $report->run();
                return view("report",["report"=>$report]);
            } else if ($report == 2) {
                //sellers service report
                $school_administrator = DB::table('schools_administrators')->select()->where('email',$email)->first();
                $report = new ReportSellersService(array("id_school"=>$school_administrator->id_school));
                $report->run();
                return view("report",["report"=>$report]);
            } else {
                dd('error');
                return redirect()->route('home')->with('failure', '¡Opción no válida!');
            }
        } else if ($user->id_user_type == 2) {
            //seller
            if ($report == 1) {
                //seller sales report
                $seller = DB::table('sellers')->select()->where('email',$email)->first();
                $report = new ReportSellerSales(array("id_seller"=>$seller->id));
                $report->run();
                return view("report",["report"=>$report]);
            } else if ($report == 2) {
                //seller service report
                $seller = DB::table('sellers')->select()->where('email',$email)->first();
                $report = new ReportSellerService(array("id_seller"=>$seller->id));
                $report->run();
                return view("report",["report"=>$report]);
            } else {
                dd('error');
                return redirect()->route('home')->with('failure', '¡Opción no válida!');
            }
        } else if ($user->id_user_type == 3) {
            //student
            if ($report == 1) {
                //most sale products by category
                $student = DB::table('students')->select()->where('email',$email)->first();
                $report = new ReportMostSalledProducts(array("id_school"=>$student->id_school));
                $report->run();
                return view("report",["report"=>$report]);
            } else if ($report == 2) {
                //price-quantity sales
                $student = DB::table('students')->select()->where('email',$email)->first();
                $report = new ReportUnitPriceSalesProducts(array("id_school"=>$student->id_school));
                $report->run();
                return view("report",["report"=>$report]);
            } else {
                dd('error');
                return redirect()->route('home')->with('failure', '¡Opción no válida!');
            }
        } else {
            return redirect()->route('home')->with('failure', '¡Opción no válida!');
        } 
    }
}
