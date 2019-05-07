@extends('viewAdmin.layout.app')
@section('title','Kategori')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Kategori</strong>
        </div>
        <div class="card-body">
          <div class="form-group">
            <form  method="POST" action="{{ route('admin.tambahKategori', $showName->id) }}" >
              @csrf
              <label for="file-multiple-input" class=" form-control-label">Kategori Produk :</label>
              @foreach($showKategoriNo as $datas)
                <div class="form-check-inline form-check">
                  <input type="checkbox" id="inline-checkbox1" name="kategori[]" value="{{ $datas->id }}" class="form-check-input">{{ $datas ->category_name }}
                </div>
              @endforeach
            </div>
            <button type="submit" class="btn btn-primary mr-2">+ Tambahkan</button>
          </form>
        </div>
        <div class="card-body">
          <strong class="card-title">Nama Product : {{ $showName->product_name }}</strong>
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
              @foreach($showKategori as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->category_name }}</td>
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
