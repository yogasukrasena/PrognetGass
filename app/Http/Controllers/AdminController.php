<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Transaksi;
use DB;
use Carbon\Carbon;
use Charts;
use App\Quotation;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifikasiAdmin;
use Auth;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        $tahun = CARBON::NOW()->format('Y');
        $reportBulanan = Transaksi::
        select(DB::raw('MONTHNAME(created_at) as bulan'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->where(DB::raw('YEAR(created_at)'),'=', $tahun)
            ->where('status','success')
            ->get();
        
        $reportTahunan = Transaksi::
        select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->where('status','success')
            ->get();
                                               
          
        return view('viewAdmin.index', compact('reportBulanan', 'reportTahunan'));
    }

     public function chart()
      {
        $tahun = CARBON::NOW()->format('Y');
        $result = \DB::table('transactions')
                    ->select(DB::raw('MONTHNAME(created_at) as bulan'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where(DB::raw('YEAR(created_at)'),'=', $tahun)
                    ->where('status','success')
                    ->get();
        return response()->json($result);
      }
}
