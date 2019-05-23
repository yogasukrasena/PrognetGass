@extends('viewAdmin.layout.app')
@section('title','Produk')
@section('content')

<div class="col-md-12">
    <div class="card">
    	@foreach($showVerif as $data)
    	@if($data->status == 'unverified')
	    	<form action="{{ route('admin.verifTransaksi', $data->id) }}" method="POST">
	    		{{ csrf_field() }}
	        {{ method_field('PUT') }}
		    		@if($data->proof_of_payment != 'Belum Upload')        	
		        	<img class="card-img-top" src="{{ asset('images/fotoBuktiPembayaran/'.$data->proof_of_payment) }}" alt="Card image cap">
		        @else
		        	<img class="card-img-top" src="{{ asset('images/placeholder.png') }}" alt="Card image cap">
		        @endif
	        <div class="card-body">
	            <h4 class="card-title mb-3">Bukti Pembayaran</h4>
	            <p class="card-text">Pastikan Bukti Pembayaran Sesuai dan Asli</p>
	            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Verif Transaksi</button>
	        </div>
	        </form>

       @elseif($data->status == 'verified')
	       <form action="{{ route('admin.delivered', $data->id) }}" method="POST">
	    		{{ csrf_field() }}
	        {{ method_field('PUT') }}
		    		@if($data->proof_of_payment != 'Belum Upload')        	
		        	<img class="card-img-top" src="{{ asset('images/fotoBuktiPembayaran/'.$data->proof_of_payment) }}" alt="Card image cap">
		        @else
		        	<img class="card-img-top" src="{{ asset('images/placeholder.png') }}" alt="Card image cap">
		        @endif
	        <div class="card-body">
	            <h4 class="card-title mb-3">Bukti Pembayaran</h4>
	            <p class="card-text">Pastikan Bukti Pembayaran Sesuai dan Asli</p>
	            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Delivired Transaksi</button>
	        </div>
	        </form>
        @endif        
        @endforeach
    </div>
</div>

@endsection