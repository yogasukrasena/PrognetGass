@extends('viewUser.layout.detailapp')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cartsfoto.jpg') }});">
		<h2 class="l-text2 t-center">
			Daftar Transaksi
		</h2>
	</section>

<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">		
		<div class="container">
			<!-- Cart item -->			
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1">Batas Pembayaran</th>
							<th class="column-2">Alamat</th>
							<th class="column-3">Courier</th>
							<th class="column-4">Total Pembayaran</th>
							<th class="column-5">Status</th>
							<th class="column-6">Detail</th>
						</tr>
						@foreach($show as $data)
						<tr class="table-row">
							<td class="column-1">{{ $data->timeout }}</td>
							<td class="column-2">{{ $data->address }}</td>
							<td class="column-3">{{ $data->courier_id }}</td>
							<td class="column-4">Rp.{{ number_format($data->sub_total) }}</td>
							<td class="column-5">{{ $data->status }}</td>
							<td class="column-6">
								@if($data->status == 'unverified')
									{{ csrf_field() }}
                	{{ method_field('DELETE') }}
									<a href="{{ route('pelanggan.detailTransaksi', $data->id) }}">Detail</a>
									<form action="{{ route('veriv.cancel', $data->id) }}" method="POST">
										{{ csrf_field() }}
                		{{ method_field('PUT') }}
										<button type="submit">Batalkan</button>
									</form>									

								@elseif($data->status == 'success')									
									<a href="{{ route('pelanggan.review', $data->id) }}">Review</a>
										
								@else
									{{ csrf_field() }}
                	{{ method_field('DELETE') }}
									<a href="{{ route('pelanggan.detailTransaksi', $data->id) }}">Detail</a>
								@endif										
								</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>		
	</section>
@endsection
