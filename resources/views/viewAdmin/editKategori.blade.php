@extends('viewAdmin.layout.app')
@section('title','inKategori')
@section('content')

@foreach ($showKategori as $data)
<form class="form-horizontal form-bordered" action="{{ route('inKategori.update', $data->id ) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="col-lg-12">
      <div class="card">
          <div class="card-header"><strong>Company</strong><small> Form</small></div>
          <div class="card-body card-block">
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
                    <label for="company" class=" form-control-label">Nama Kategori</label>
                    <input type="text" id="company" placeholder="Masukan Nama" class="form-control" name="namaKategori"
                    value="{{ $data->category_name }}">
                </div>

              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </div>
        </div>
    </div>
</form>
@endforeach
@endsection
