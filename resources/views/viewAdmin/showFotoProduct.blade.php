@extends('viewAdmin.layout.app')
@section('title','Admin')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Foto Product</strong>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.tambahFoto', $showName->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="file-multiple-input" class=" form-control-label">Gambar Produk</label>
              <input type="file" id="file-multiple-input" multiple="multiple" class="form-control-file" name="gambarProduk[]">
            </div>
            <button type="submit" class="btn btn-primary mr-2">+ Tambah</button>
          </form>
        </div>
        <div class="form-group">
          @if (session('alert'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
            </div>
          @endif
        </div>
        <div class="card-body">
          <strong class="card-title">Nama Product : {{ $showName->product_name }}</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Nama Foto</th>
                  <th scope="col">Foto Produk</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              @foreach($showImage as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->image_name }}</td>
                  <td><img src="{{ asset('images/fotoProduct/'.$data->image_name) }}" alt="image" height="60" weight="60"></td>
                  <td class="actions">
                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                     <i class="fa fa-calendar-o"></i>
                  </td>
              @endforeach
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
