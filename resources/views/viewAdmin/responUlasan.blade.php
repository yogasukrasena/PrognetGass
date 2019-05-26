@extends('viewAdmin.layout.app')
@section('title','inKategori')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header"><strong>Company</strong><small> Form</small></div>
        <div class="card-body card-block">
          <form class="forms-sample"  method="POST" action="{{ route('admin.storeRespon') }}" >
            @csrf
            <div class="form-group">
              @if (session('alert'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
                </div>
              @endif
            </div>
            @foreach($review as $data)
            <input type="hidden" id="company" placeholder="Nama" class="form-control" name="idUlasan" value="{{ $data->id }}">
            <div class="form-group">
              <label for="company" class=" form-control-label">Pemberi Ulasan</label>
              <input type="text" id="company" placeholder="Nama" class="form-control" name="pemberiUlasan" disabled="disabled" value="{{ $data->name }}">
            </div> 
            <div class="form-group">
              <label for="company" class=" form-control-label">Nama Produk</label>
              <input type="text" id="company" placeholder="Nama" class="form-control" name="namaProduk" disabled="disabled" value="{{ $data->product_name }}">
            </div>             
            <div class="form-group">
              <label for="street" class=" form-control-label">Respon Ulasan</label>
              <textarea id="street" placeholder="Respon Ulasan" class="form-control"  name="responUlasan"></textarea>
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>                    
          </div>
          @endforeach
      </div>
  </form>
@endsection