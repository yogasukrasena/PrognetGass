<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Transaksi;
use DB;
use Charts;
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

        $reportTahunan = Transaksi::where(DB::raw("(date_format(created_at, '%Y'))"), date('Y'))
                    ->get();

        $chart = Charts::database($reportTahunan, 'bar', 'highcharts')
                  ->title("Transaksi Perbulan")
                  ->elementLabel("Total Users")
                  ->dimensions(1000, 500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'), true);                    

        return view('viewAdmin.index', compact('chart', 'reportTahunan'));
    }
}
