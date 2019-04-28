<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Storage;
use App\Kategori;
use App\KategoriProduk;
use App\Produk;
use App\GambarProduk;
use File;

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

          if($files = $request->input('kategori')){
            foreach ($files as $file) {
                $inKategoriP = new KategoriProduk;
                $inKategoriP->product_id = $inProduct->id;
                $inKategoriP->category_id = $file;
                $inKategoriP->save();
            }
        }


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
         $showProduct = Produk::where('id',$id)->get();
         $showKategoriD = KategoriProduk::where('product_id',$id)->get();
         $showKategori = Kategori::select('product_categories.*')->get();
         $showImage = GambarProduk::where('product_id',$id)->get();

         return view('viewAdmin.editProduct', compact('showKategoriD','showProduct','showImage','showKategori'));
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

    public function showProduct()
    {
        $showProduct = Produk::all();

        return view('viewAdmin.showProduct', compact('showProduct'));
    }


    public function showKategoridetail($id){

    $showKategori = KategoriProduk::join('product_categories', 'product_categories.id',
                    '=', 'product_category_details.category_id')
                    ->select('product_categories.category_name')
                    ->where('product_category_details.product_id', $id)->get();
    $tampil = KategoriProduk::select('product_category_details.*')->where('product_id',$id)->get();
    $tampilKategori = Kategori::select('product_categories.*')->get();
    $showName = Produk::where('id',$id)->first();

    return view('viewAdmin.showDetKProduct', compact('showKategori', 'showName', 'tampilKategori'));
    }


    public function kategoriStore(request $request, $id)
    {
        if($files = $request->input('kategori'))
        {
            foreach ($files as $file) {
                $inKategoriP = new KategoriProduk;
                $inKategoriP->product_id = $id;
                $inKategoriP->category_id = $file;
                $inKategoriP->save();
            }
        }
        return redirect()->back()->with('alert','Data Sukses di Tambahkan');
    }

    public function showFotodetail($id)
    {

        $showName = Produk::where('id',$id)->first();
        $showImage = GambarProduk::where('product_id',$id)->get();

        return view('viewAdmin.showFotoProduct', compact('showImage', 'showName'));
    }


    public function fotoStore(request $request, $id)
    {
         if($files=$request->file('gambarProduk')){
            foreach($files as $file){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filenameToStore = $filename.'_'.time().'.'.$extension;
                $path = $file->move(public_path('images/fotoProduct'), $filenameToStore);

                $inImage = new GambarProduk;
                $inImage->product_id = $id;
                $inImage->image_name = $filenameToStore;
                $inImage->save();
            }
        }
        return redirect()->back()->with('alert','Data Sukses di Tambahkan');
    }


    public function hapus($id){

        $gambar = GambarProduk::select('image_name')->where('product_id', $id)->get();
        $image_path = "images/fotoProduct/".$gambar;

        unlink($image_path);
        // if(File::exists($image_path)){
        //     File::delete($image_path);
        // }

        GambarProduk::where('product_id', $id)->delete();
        KategoriProduk::where('product_id', $id)->delete();

        Produk::where('id',$id)->delete();

        return redirect()->back()->with('alert','Data Berhasil di Hapus');

    }
}
