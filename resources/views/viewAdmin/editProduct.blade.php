@extends('viewAdmin.layout.app')
@section('title','inKategori')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Company</strong><small> Form</small></div>
        <div class="card-body card-block">
          @foreach($showProduct as $dataP)
          <form class="forms-sample"  method="POST" action="{{ route('inProduct.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            {{ method_field('PUT') }}
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
              <input type="text" id="company" placeholder="Nama" class="form-control" name="namaProduk" value="{{ $dataP->product_name }}">
            </div>
            <div class="form-group">
              <label for="vat" class=" form-control-label">Harga Produk</label>
              <input type="number" id="vat" placeholder="1000,00" class="form-control" name="hargaProduk" value="{{ $dataP->price }}">
            </div>
            <div class="form-group">
              <label for="street" class=" form-control-label">Jumlah Produk</label>
              <input type="number" id="street" placeholder="Satuan" class="form-control" name="jumlahProduk" value="{{ $dataP->stock }}">
            </div>
             <div class="form-group">
              <label for="street" class=" form-control-label">Berat Produk</label>
              <input type="text" id="street" placeholder="Gram" class="form-control" name="beratProduk" value="{{ $dataP->weight }}">
            </div>
            <div class="form-group">
              <label for="street" class=" form-control-label">Raiting</label>
              <input type="text" id="street" placeholder="Raiting" class="form-control"  name="raitingProduk" value="{{ $dataP->product_rate }}">
            </div>
            <div class="form-group">
              <label for="file-multiple-input" class=" form-control-label">Gambar Produk</label>
              <a href="{{ route('admin.FotoD', $dataP->id) }}">Detail</a>
            </div>
            <div class="form-group">
              <label for="file-multiple-input" class=" form-control-label">Kategori Produk :</label>
              <a href="{{ route('admin.KPdetail', $dataP->id) }}">Detail</a>
            </div>
            <div class="form-group">
              <label for="street" class=" form-control-label">Deskripsi Produk</label>
              <textarea id="street" placeholder="Penjelasan Produk" class="form-control"  name="deskripsiProduk">{{ $dataP->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>                    
          </div>
      </div>
  </form>
  @endforeach
@endsection