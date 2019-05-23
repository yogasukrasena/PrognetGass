@extends('viewUser.layout.detailapp')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cartsfoto.jpg') }});">
		<h2 class="l-text2 t-center">
			Detail Transaksi
		</h2>
	</section>

<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">		
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-4 p-l-70">Quantity</th>
							<th class="column-5">Total</th>
						</tr>
						@foreach($show as $data)						
						<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="{{ asset('images/fotoProduct/'.$data->image_name) }}" alt="IMG-PRODUCT" height="100" width="100">
								</div>
							</td>
							<td class="column-2">{{ $data->product_name }}</td>
							<td class="column-3">Rp.{{ number_format($data->price) }}</td>
							<td class="column-4">
								<input class="size8 m-text18 t-center num-product" type="number" name="jumlahProduct[]" value="{{ $data->qty }}">
							</td>
							<td class="column-5">Rp.{{ number_format($data->selling_price) }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">				
				
			</div>
		
			<!-- Total -->
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Cart Totals
				</h5>

				@foreach($showDetail as $data)
				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						<input type="text" name="total" value="{{ number_format($data->total) }}">						
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Shipping:
					</span>

					<div class="w-size20 w-full-sm">
						<p class="s-text8 p-b-23">
							There are no shipping methods available. Please double check your address, or contact us if you need any help.
						</p>

						<span class="s-text19">
							Alamat Tujuan
						</span>	

						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" disabled="disabled" name="alamat" placeholder="Alamat Tujuan" value="{{ $data->address }}">
						</div>

						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" disabled="disabled" name="alamat" placeholder="Alamat Tujuan" value="{{ $data->regency }}">
						</div>

						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" disabled="disabled" name="alamat" placeholder="Alamat Tujuan" value="{{ $data->province }}">
						</div>

						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" disabled="disabled" name="alamat" placeholder="Alamat Tujuan" value="{{ $data->courier_id }}">
						</div>
						
						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" disabled="disabled" name="alamat" placeholder="Alamat Tujuan" value="{{ $data->shipping_cost }}">
						</div>		
					</div>
				</div>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						Rp.{{ number_format($data->sub_total) }}
					</span>
				</div>

				@if($data->status == 'unverified')
					<form action="{{ route('pelanggan.verifV2', $data->id) }}" class="flex-c-m sizefull">
						@csrf
						<div class="size15 trans-0-4  m-b-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Upload Bukti Pembayaran
							</button>
						</div>
					</form>

				@elseif($data->status == 'delivered')
					<form action="{{ route('veriv.success', $data->id) }}" class="flex-c-m sizefull" method="POST">
						{{ csrf_field() }}
            {{ method_field('PUT') }}
						<div class="size15 trans-0-4  m-b-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Konfirmasi Barang Sampai
							</button>
						</div>
					</form>

				@else
					<div class="size15 trans-0-4  m-b-10">
						<!-- Button -->					
					</div>
				@endif
				@endforeach
			</div>
		</div>
		</form>
	</section>
@endsection
