@extends('viewAdmin.layout.app')
@section('title','Kategori')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Kategori</strong>
        </div>
        <div class="card-body">
          <form action="{{ route('inKategori.index') }}">
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
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Nama Kategori</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              @foreach($tampilKategori as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->category_name }}</td>
                  <td class="actions">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a href="{{ route('inKategori.edit', $data->id) }}" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
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
