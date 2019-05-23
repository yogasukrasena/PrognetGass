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
                                  <th>Batas Pembayaran</th>
                                  <th>User</th>
                                  <th>Alamat</th>
                                  <th>Courier</th>
                                  <th>Bukti Pembayaran</th>
                                  <th>Total Pembayaran</th>
                                  <th>Status</th>
                                  <th>Detail</th>                                  
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($show as $data)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $data->timeout }}</td>
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->address }}</td>
                                  <td>{{ $data->courier_id }}</td>
                                  @if($data->proof_of_payment != 'Belum Upload')                                    
                                     <td><img src="{{ asset('images/fotoBuktiPembayaran/'.$data->proof_of_payment) }}" alt="image" height="60" weight="60"></td>
                                  @else
                                    <td>Belum di Upload</td>
                                  @endif
                                  <td>{{ $data->sub_total }}</td>
                                  <td>{{ $data->status }}</td>                                                                  
                                  <td>
                                    {{-- {{ csrf_field() }}
                                    {{ method_field('DELETE') }} --}}
                                    <form action="{{ route('transaksi.show', $data->id) }}" action="POST">
                                      <button type="submit" class="btn btn-primary btn-sm">Detail</button>
                                    </form>                                                                  
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