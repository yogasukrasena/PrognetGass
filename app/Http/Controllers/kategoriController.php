<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Kategori;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('viewAdmin.inKategori');
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

     public function tampil()
    {
        //
        $tampilKategori = Kategori::all();

        return view('viewAdmin.showKategori', compact('tampilKategori'));
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
        $inKategori = new Kategori;

        $inKategori->category_name = $request->namaKategori;

        $inKategori->save();
        // DB::Table('product_categories')->insert(
        //     [
        //         'category_name'=>$request->namaKategori
        //     ]
        // );
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
        $showKategori = Kategori::select('product_categories.*')
        ->where('id',$id)->get();

        return view('viewAdmin.editKategori', compact('showKategori'));
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
        $inKategori = Kategori::find($id);

        $inKategori->category_name = $request->namaKategori;

        $inKategori->save();

        return redirect()->route('admin.showKategori')->with('alert','Data Sukses di Tambahkan');
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
