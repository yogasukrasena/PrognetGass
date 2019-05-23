<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\NotifikasiAdmin;
use Illuminate\Notifications\Notifiable;
use App\Carts;
use App\Produk;
use App\GambarProduk;
use App\Courier;
use App\Transaksi;
use App\TransaksiDetail;
use App\ReviewProduk;
use Carbon\Carbon;
use Auth;
use DB;
use GuzzleHttp\Client;

class cartsController extends Controller
{

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
        //data kota
        $Client = new Client(); 

        try{
            $response = $Client->get('https://api.rajaongkir.com/starter/city', 
                array(
                    'headers' => array(
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                    )
                )   
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result   = json_decode($json, true);
        $dataCity = $array_result["rajaongkir"]["results"];        


        //data provinsi
        $Client = new Client(); 

        try{
            $response = $Client->get('https://api.rajaongkir.com/starter/province', 
                array(
                    'headers' => array(
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                    )
                )   
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result   = json_decode($json, true);
        $dataProv = $array_result["rajaongkir"]["results"];
                
        // show chart

        $carts = Produk::join('carts', 'products.id', '=', 'carts.product_id')
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->select('carts.user_id', 'carts.qty', 'products.weight', 'products.product_name', 'products.price', 'product_images.image_name')
                ->groupBy('products.id')
                ->where('carts.user_id', Auth::user()->id)
                ->where('Carts.status', '=', 'notyet')
                ->get();

        $daftarKurir = Courier::select('couriers.*')->get();

        return view('viewUser.cart', compact('carts', 'dataProv', 'dataCity', 'daftarKurir'));

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
        $inCarts = new Carts;

        $inCarts->user_id = Auth::user()->id;
        $inCarts->product_id = $request->id_product;
        $inCarts->qty = $request->jumlahPembelian;
        $inCarts->status = "notyet";

        $inCarts->save();

        return redirect()->back()->with('alert','Sukses di Tambahkan Kedalam Carts');
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
        $showCart = Carts::select('carts.*')->where('carts.id',$id)->get();
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

    public function chekout(Request $request){
        //data kota
        $Client = new Client(); 

        try{
            $response = $Client->get('https://api.rajaongkir.com/starter/city', 
                array(
                    'headers' => array(
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                    )
                )   
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result   = json_decode($json, true);
        $dataCity = $array_result["rajaongkir"]["results"]; 
        $jum = count($dataCity);
        $countnya = $dataCity;
        $kota = $request->kota;
        $alamat = $request->alamat;
        $kurir = $request->kurir;
        for($i =0; $i < $jum; $i++){
            if($countnya[$i]["city_id"] == $kota){
                $kotaData = $countnya[$i]["city_name"];
                $prov_idData = $countnya[$i]["province_id"];

            }
        }

        //data provinsi
        $Client = new Client(); 

        try{
            $response = $Client->get('https://api.rajaongkir.com/starter/province', 
                array(
                    'headers' => array(
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                    )
                )   
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result   = json_decode($json, true);
        $dataProv = $array_result["rajaongkir"]["results"];
        $count_prov = count($dataProv);
        for ($i=0; $i < $count_prov; $i++){
            if($dataProv[$i]["province_id"] == $prov_idData){
                $provinsi = $dataProv[$i]["province"];
            }
        }

        //cekshipping
            
        $Client = new Client(); 

        try{
            $response = $Client->request('POST','https://api.rajaongkir.com/starter/cost', 
                [
                    'body' => 'origin=114&destination='.$request->kota.'&weight='.$request->berat.'&courier='.$request->kurir,
                    'headers' => [
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                        'content-type' => 'application/x-www-form-urlencoded',
                    ]
                ]
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();

        $array_result   = json_decode($json, true);     

        $dataOngkir = $array_result["rajaongkir"]["results"]["0"]["costs"];

        //return $dataOngkir;        
                
        // show chart

        $carts = Produk::join('carts', 'products.id', '=', 'carts.product_id')
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->select('products.id','products.id','carts.user_id', 'carts.qty', 'products.weight', 'products.product_name', 'products.price', 'product_images.image_name')
                ->groupBy('products.id')
                ->where('carts.user_id', Auth::user()->id)
                ->where('carts.status', '=', 'notyet')
                ->get();
        $daftarKurir = Courier::select('couriers.*')->get();

        return view('viewUser.chekout', compact('carts', 'kota', 'kotaData', 'dataCity', 'alamat', 'provinsi', 'dataProv','prov_idData', 'dataOngkir', 'kurir', 'daftarKurir'));
    }

    public function review(Request $request){

         //data kota
        $Client = new Client(); 

        try{
            $response = $Client->get('https://api.rajaongkir.com/starter/city', 
                array(
                    'headers' => array(
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                    )
                )   
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result   = json_decode($json, true);
        $dataCity = $array_result["rajaongkir"]["results"]; 
        $jum = count($dataCity);
        $countnya = $dataCity;
        $kota = $request->kota;
        $alamat = $request->alamat;
        $kurir = $request->kurir;
        for($i =0; $i < $jum; $i++){
            if($countnya[$i]["city_id"] == $kota){
                $kotaData = $countnya[$i]["city_name"];
                $prov_idData = $countnya[$i]["province_id"];

            }
        }

        //data provinsi
        $Client = new Client(); 

        try{
            $response = $Client->get('https://api.rajaongkir.com/starter/province', 
                array(
                    'headers' => array(
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                    )
                )   
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result   = json_decode($json, true);
        $dataProv = $array_result["rajaongkir"]["results"];
        $count_prov = count($dataProv);
        for ($i=0; $i < $count_prov; $i++){
            if($dataProv[$i]["province_id"] == $prov_idData){
                $provinsi = $dataProv[$i]["province"];
            }
        }

         //cekshipping
            
        $Client = new Client(); 

        try{
            $response = $Client->request('POST','https://api.rajaongkir.com/starter/cost', 
                [
                    'body' => 'origin=114&destination='.$request->kota.'&weight='.$request->berat.'&courier='.$request->kurir,
                    'headers' => [
                        'key' => '985c4bb806eb47103b6d204bec3b1245',
                        'content-type' => 'application/x-www-form-urlencoded',
                    ]
                ]
            );
        } catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();

        $array_result   = json_decode($json, true);     

        $dataOngkir = $array_result["rajaongkir"]["results"]["0"]["costs"];

        $carts = Produk::join('carts', 'products.id', '=', 'carts.product_id')
                ->join('product_images', 'products.id', '=', 'product_images.product_id')
                ->select('products.id','carts.user_id', 'carts.qty', 'products.weight', 'products.product_name', 'products.price', 'product_images.image_name')
                ->groupBy('products.id')
                ->where('carts.status', '=', 'notyet')
                ->where('carts.user_id', Auth::user()->id)
                ->get();
        $daftarKurir = Courier::select('couriers.*')->get();

        $subtotal = $request->totalBarang;
        $berat = $request->berat;       
        $alamat = $request->alamat;
        $kurir = $request->kurir;
        $ongkir = $request->ongkir;

        $totalBiaya = $subtotal + $ongkir;
        
        $now = Carbon::now('Asia/Makassar')->format('H:i:s');
        $interval = Carbon::now('Asia/Makassar')->add(1,'day')->format('Y-m-d H:i:s');
        

        return view('viewUser.reviewOrder', compact('dataOngkir', 'carts', 'daftarKurir', 'subtotal', 'berat', 'kota', 'provinsi', 'alamat', 'kurir', 'ongkir', 'dataCity', 'dataProv', 'prov_idData', 'totalBiaya'));

    }

    public function storeTransaksi(Request $request){
        
        //store data transaksi

        $inTransaksi = new Transaksi;
        $inTransaksi->timeout = Carbon::now('Asia/Makassar')->add(1,'day')
                                   ->format('Y-m-d H:i:s');
        $inTransaksi->address = $request->alamat;
        $inTransaksi->regency = $request->kota;
        $inTransaksi->province = $request->provinsi;
        $inTransaksi->total = $request->totalBarang;
        $inTransaksi->shipping_cost = $request->hargaOngkir;
        $inTransaksi->sub_total = $request->totalBayar;
        $inTransaksi->user_id = Auth::user()->id;
        $inTransaksi->courier_id = $request->kurir;
        $inTransaksi->proof_of_payment = 'Belum Upload';
        $inTransaksi->status = 'unverified';
        $inTransaksi->save();

        //store data detail transaksi

        $files = $request->input('idProduct');
        $hargaAdep = $request->input('hargaJual');
        $jumlah = $request->input('jumlahProduct');
        
        for ($i=0; $i < count($files) ; $i++) { 
            $inDetailT = new TransaksiDetail;
            $inDetailT->transaction_id = $inTransaksi->id;                
            $inDetailT->qty = $jumlah[$i];                    
            $inDetailT->product_id = $files[$i];                
            $inDetailT->discount = '0';                
            $inDetailT->selling_price = $hargaAdep[$i];                    
            $inDetailT->save();
        }

        $cartid = TransaksiDetail::where('transaction_details.transaction_id',$inTransaksi->id)
        ->get();        
        
        foreach ($cartid as $data) {

            $cartStatus = DB::table('carts')
                ->where('product_id', $data->product_id)
                ->where('status','notyet')
                ->update(['status' => 'checkedout']);             
        }
        

        $admin = Admin::first();
        $admin->notify(new NotifikasiAdmin('ada TRANSAKSI Baru Yang Masuk '));                                                                         
        return redirect('/user');
    }

    public function verifPembayaran(){

        $datenow = Carbon::now('Asia/Makassar')->format('Y-m-d H:i:s');

        $timeout = Transaksi::select('transactions.timeout', 'transactions.id')
        ->where('transactions.user_id', Auth::user()->id)->first();

        return view('viewUser.verifPay', compact('timeout', 'datenow'));
    }

    public function verifPembayaranV2($id){

        $datenow = Carbon::now('Asia/Makassar')->format('Y-m-d H:i:s');

        $timeout = Transaksi::select('transactions.timeout', 'transactions.id')
        ->where('transactions.id', $id)->first();

        return view('viewUser.verifPay', compact('timeout', 'datenow'));
    }

    public function updateVeriv(Request $request, $id){

        $veriv = Transaksi::find($id);

        if ($file = $request->file('buktiPembayaran')) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $file->move(public_path('images/fotoBuktiPembayaran'), $filenameToStore);
            $veriv->proof_of_payment = $filenameToStore;
        }
        $veriv->save();

        return redirect()->back();   
    }

    public function showTransaksi(){

        $show = Transaksi::select('transactions.*')
        ->where('transactions.user_id', Auth::user()->id)->get();

        return view('viewUser.daftarTransaksi', compact('show'));
    }

    public function detailTransaksi($id){

        $show = TransaksiDetail::select('transactions.*', 'transaction_details.*', 'products.*', 'product_images.*')        
        ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'products.id', '=', 'transaction_details.product_id')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->where('transaction_details.transaction_id', $id)
        ->groupBy('products.id')
        ->get();

        $showDetail = Transaksi::select('transactions.*')
        ->where('transactions.id', $id)->get();

        return view('viewUser.detailTransaksi', compact('show', 'showDetail'));
    }

    public function cancelVeriv(Request $request, $id){

        $veriv = Transaksi::find($id);
        $veriv->status = 'expired';
        
        $veriv->save();

        return redirect()->back();   
    }

    public function success($id){

        $verif = Transaksi::find($id);
        $verif->status = 'success';

        $verif->save();        

        $show = TransaksiDetail::select('transactions.*', 'transaction_details.*', 'products.*', 'product_images.*')        
        ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'products.id', '=', 'transaction_details.product_id')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->where('transaction_details.transaction_id', $id)
        ->groupBy('products.id')
        ->get();

        $showDetail = Transaksi::select('transactions.*')
        ->where('transactions.id', $id)->get();

        return view('viewUser.detailTransaksi', compact('show', 'showDetail'));
    }

     public function reviewProduk($id){
                
        $show = TransaksiDetail::select('transactions.*', 'transaction_details.*', 'products.*', 'product_images.*')        
        ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'products.id', '=', 'transaction_details.product_id')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->where('transaction_details.transaction_id', $id)
        ->groupBy('products.id')
        ->get();

        $showDetail = Transaksi::select('transactions.*')
        ->where('transactions.id', $id)->get();        

        return view('viewUser.daftarReview', compact('show', 'showDetail'));
    }

    public function inputReview($id){

        $show = Produk::select('products.*')->where('products.id',$id)->get();

        $review = ReviewProduk::select('product_reviews.*')
        ->where('product_reviews.product_id', $id)
        ->where('product_reviews.user_id', Auth::id())->first();

        return view('viewUser.reviewInput', compact('show', 'review'));
    }

    public function storeReview(Request $request){

        $inReview = new ReviewProduk;

        $inReview->product_id = $request->produk_id;
        $inReview->user_id = Auth::id();
        $inReview->rate = $request->rating;
        $inReview->content = $request->ulasan;

        $inReview->save();

        return redirect()->back();
    }

   

}


    

