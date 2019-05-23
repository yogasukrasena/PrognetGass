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
                                  <th>Nama User</th>
                                  <th>Rate</th>
                                  <th>Content</th>
                                  <th>Respon</th>                                 
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($review as $data)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $data->product_name }}</td>
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->rate }}</td>
                                  <td>{{ $data->content }}</td>
                                  <td><a href="{{ route('admin.inRespon', $data->product_id) }}">Detail</a>
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