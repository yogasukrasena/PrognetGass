@extends('viewAdmin.layout.app')
@section('title','inKategori')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Company</strong><small> Form</small></div>
        <div class="card-body card-block">
          <form class="forms-sample"  method="POST" action="{{ route('inProduct.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              @if (session('alert'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
                </div>
              @endif
            </div>
            <div class="form-group">
              <label for="company" class=" form-control-label">Nama Produk</label>
              <input type="text" id="company" placeholder="Nama" class="form-control" name="namaProduk">
            </div>
            <div class="form-group">
              <label for="vat" class=" form-control-label">Harga Produk</label>
              <input type="number" id="vat" placeholder="1000,00" class="form-control" name="hargaProduk">
            </div>
            <div class="form-group">
              <label for="street" class=" form-control-label">Jumlah Produk</label>
              <input type="number" id="street" placeholder="Satuan" class="form-control" name="jumlahProduk">
            </div>
             <div class="form-group">
              <label for="street" class=" form-control-label">Berat Produk</label>
              <input type="text" id="street" placeholder="Gram" class="form-control" name="beratProduk">
            </div>
            <div class="form-group">
              <label for="street" class=" form-control-label">Raiting</label>
              <input type="text" id="street" placeholder="Raiting" class="form-control"  name="raitingProduk">
            </div>
            <div class="form-group">
              <label for="file-multiple-input" class=" form-control-label">Gambar Produk</label>
              <input type="file" id="file-multiple-input" multiple="multiple" class="form-control-file" name="gambarProduk[]">
            </div>
            <div class="form-group">
              <label for="file-multiple-input" class=" form-control-label">Kategori Produk :</label>
              @foreach($showKategori as $datas)
                <div class="form-check-inline form-check">
                  <input type="checkbox" id="inline-checkbox1" name="kategori[]" value="{{ $datas->id }}" class="form-check-input">{{ $datas ->category_name }}
                </div>
                @endforeach
            </div>
            <div class="form-group">
              <label for="street" class=" form-control-label">Deskripsi Produk</label>
              <textarea id="street" placeholder="Penjelasan Produk" class="form-control"  name="deskripsiProduk"></textarea>
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>                    
          </div>
      </div>
  </form>
@endsection