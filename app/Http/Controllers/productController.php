<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Kategori;
use App\KategoriProduk;
use App\Produk;
use App\GambarProduk;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $showKategori = Kategori::select('product_categories.*')->get();

         

        return view('viewAdmin.inProduct', compact('showKategori'));
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
        // store table producks
        $inProduct = new Produk;

        $inProduct->product_name = $request->namaProduk;
        $inProduct->price = $request->hargaProduk;
        $inProduct->stock = $request->jumlahProduk;
        $inProduct->weight = $request->beratProduk;
        $inProduct->product_rate = $request->raitingProduk;
        $inProduct->description = $request->deskripsiProduk;

        $inProduct->save();

        // store gambar produk

       
        if($files=$request->file('gambarProduk')){
            foreach($files as $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filenameToStore = $filename.'_'.time().'.'.$extension;
                $path = $file->move(public_path('images/fotoProduct'), $filenameToStore);

                $inImage = new GambarProduk;
                $inImage->product_id = $inProduct->id;
                $inImage->image_name = $filenameToStore;
                $inImage->save();
            }
        }

        // store kategori produk

        $inKategoriP = new KategoriProduk;

        $inKategoriP->product_id = $inProduct->id;
        $inKategoriP->category_id = $request->kategori;

        $inKategoriP->save();

        // menampilkan kategori

        $showKategori = Kategori::select('product_categories.category_name')->get();

        return redirect()->back()->with('alert','Data Sukses di Tambahkan');
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
}
