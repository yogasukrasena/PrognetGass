<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\GambarProduk;
use App\KategoriProduk;
use App\Carts;
use App\User;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bestSeller = Produk::select('products.id', 'products.product_name', 'product_images.image_name', 'products.price')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->join('product_category_details', 'products.id', '=', 'product_category_details.product_id')
        ->groupBy('products.id')
        ->where('product_category_details.category_id', '=', '9')
        ->get();


        return view('viewUser.index', compact('bestSeller'));
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
        $inCarts->status = "checkedout";

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
        $showData = Produk::select('products.*')
        ->where('products.id', $id)
        ->get();

        $showKategori = KategoriProduk::join('product_categories', 'product_category_details.category_id', '=', 'product_categories.id')
        ->join('products', 'product_category_details.product_id', '=', 'products.id')
        ->select('product_categories.category_name')
        ->where('product_category_details.product_id', $id)
        ->get();

        $showFoto = GambarProduk::select('product_images.image_name')->where('product_id', $id)
        ->first();

        $countFoto = GambarProduk::select('product_images.*')->where('product_id', $id)->count();
                    
        $showFotoside = GambarProduk::select('product_images.image_name')->where('product_id', $id)
        ->limit(2)->orderBy('product_images.id', 'DESC')
        ->get();

        $showProduct =Produk::select('products.id', 'products.product_name', 'product_images.image_name', 'products.price')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->join('product_category_details', 'products.id', '=', 'product_category_details.product_id')
        ->groupBy('products.id')
        ->where('product_category_details.category_id', '=', '9')
        ->get();

        return view('viewUser.detailProduct', compact('showData', 'showFoto', 'showKategori', 'showProduct', 'showFotoside', 'countFoto'));
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

    public function edituser($id){

        $editU = User::select('users.*')->where('id', $id)->get();

        return view('auth.editRegister', compact('editU'));
    }

    public function updateUser(Request $request, $id){

        $inData = User::find($id);

        $inData->name = $request->name;
        $inData->email = $request->email;

        if($file=$request->file('profileimage')){
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $file->move(public_path('images/fotoProfileUsers'), $filenameToStore);
            $inData->profile_image = $filenameToStore;
        }
        $inData->save();
        return redirect()->back()->with('alert','Data Sukses di Tambahkan');
    }
}
