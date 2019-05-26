<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\ReviewProduk;
use App\Produk;
use App\ResponReview;
use App\Admin;
use App\User;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifikasiAdmin;
use App\Notifications\NotifikasiUser;
use Auth;

class transaksiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $show = Transaksi::select('transactions.*', 'users.name')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->get();
        
        return view('viewAdmin.showTransaksi', compact('show'));
    }

    public function markRead(){

        $admin = Admin::first();
        $admin->unreadNotifications()->update(['read_at' => now()]);

        return redirect()->back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
        $showVerif = Transaksi::select('transactions.*')
        ->where('transactions.id',$id)->get();


        return view('viewAdmin.detailTransaksiAdmin', compact('showVerif'));
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

    public function verif($id){

        $verif = Transaksi::find($id);
        $verif->status = 'verified';
        $verif->save();

        $show = Transaksi::select('transactions.*', 'users.name')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->get();

        $user_id = $verif->user_id;
        $useid = User::where('id',$user_id)->get();

        foreach($useid as $data)        
        $data->notify(new NotifikasiUser('Transaksi Terverifikasi'));

        return view('viewAdmin.showTransaksi', compact('show'));
    }

     public function delified($id){

        $verif = Transaksi::find($id);
        $verif->status = 'delivered';
        $verif->save();

        $user_id = $verif->user_id;
        $useid = User::where('id',$user_id)->get();

        $show = Transaksi::select('transactions.*', 'users.name')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->get();

        foreach($useid as $data)        
        $data->notify(new NotifikasiUser('Barang Pesanan Dikirim'));

        return view('viewAdmin.showTransaksi', compact('show'));
    }

    public function showReview(){

        $review = ReviewProduk::select('product_reviews.*', 'products.product_name', 'users.name')
        ->join('products', 'products.id', '=', 'product_reviews.product_id')
        ->join('users', 'users.id', '=', 'product_reviews.user_id')
        ->get();

        return view('viewAdmin.reviewProduk', compact('review'));

    }

     public function inputResponse($id){

        $show = Produk::select('products.*')->where('products.id',$id)->get();

        $review = ReviewProduk::select('product_reviews.*', 'products.product_name', 'users.name')
        ->join('products', 'products.id', '=', 'product_reviews.product_id')
        ->join('users', 'users.id', '=', 'product_reviews.user_id')
        ->where('product_reviews.product_id', $id)
        ->get();

        return view('viewAdmin.responUlasan', compact('show', 'review'));
    }

    public function storeRespon(Request $request){

        $inReview = new ResponReview;

        $inReview->review_id = $request->idUlasan;
        $inReview->admin_id = Auth::guard('admin')->user()->id;        
        $inReview->content = $request->responUlasan;

        $inReview->save();

        $user_id = ReviewProduk::select('product_reviews.user_id')
        ->where('product_reviews.id', $request->idUlasan)->get();

        $useid = User::where('id',$user_id)->get();
  
        foreach($useid as $data){
            $data->notify(new NotifikasiUser('Transaksi Terverifikasi'));    
        }        
        


        return redirect()->back()->with('alert','Respon Berhasil di Tambahkan');
    }         

    
}
