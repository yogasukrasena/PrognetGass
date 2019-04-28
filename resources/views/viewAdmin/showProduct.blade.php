@extends('viewAdmin.layout.app')
@section('title','Produk')
@section('content')

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Data Produk</strong>
                  </div>
                  <div class="card-body">
                      <form action="{{ route('inProduct.index') }}">
                        <button type="submit" class="btn btn-primary mr-2">+ Tambahkan</button>
                      </form>
                       <div class="form-group">
                        @if (session('alert'))
                          <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
                          </div>
                        @endif
                      </div>
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>NO</th>
                                  <th>Nama Produk</th>
                                  <th>Harga</th>
                                  <th>Rate</th>
                                  <th>Foto</th>
                                  <th>Kategori</th>
                                  <th>Deskripsi</th>
                                  <th>Berat</th>
                                  <th>Stok</th>
                                  <th>Edit</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($showProduct as $data)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $data->product_name }}</td>
                                  <td>{{ $data->price }}</td>
                                  <td>{{ $data->product_rate }}</td>
                                  <td>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.FotoD', $data->id) }}">Detail</a>
                                  </td>
                                  <td>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.KPdetail', $data->id) }}">Detail</a>
                                  </td>
                                  <td>{{ $data->description }}</td>
                                  <td>{{ $data->weight }}</td>
                                  <td>{{ $data->stock }}</td>
                                  <td class="actions">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('inProduct.edit', $data->id) }}" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                    <a href="{{ route('admin.hapus', $data->id) }}" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                  </td>
                              </tr>
                              @endforeach    
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection