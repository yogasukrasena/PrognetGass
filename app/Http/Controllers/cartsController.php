<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carts;
use App\Produk;
use App\GambarProduk;
use App\Courier;
use Auth;
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
                ->select('carts.user_id', 'carts.qty', 'products.weight', 'products.product_name', 'products.price', 'product_images.image_name')
                ->groupBy('products.id')
                ->where('carts.user_id', Auth::user()->id)
                ->get();
        $daftarKurir = Courier::select('couriers.*')->get();

        return view('viewUser.chekout', compact('carts', 'kota', 'kotaData', 'dataCity', 'alamat', 'provinsi', 'dataProv','prov_idData', 'dataOngkir', 'kurir', 'daftarKurir'));
        }
    }


    

