@extends('viewUser.layout.detailapp')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cartsfoto.jpg') }});">
		<h2 class="l-text2 t-center">
			Review Order
		</h2>
	</section>

<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<form action="{{ route('pelanggan.transaksi') }}" method="POST" enctype="multipart/form-data">
		<div class="container">
			{{ csrf_field() }}  
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
						@foreach($carts as $data)
						<input type="hidden" name="hargaJual[]" value="{{ $data->qty * $data->price }}">
						<input type="hidden" name="idProduct[]" value="{{ $data->id }}">
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
							<td class="column-5">Rp.{{ number_format($data->qty * $data->price) }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">				
				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div>
			</div>			
			<!-- Total -->
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Cart Totals
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal(Rp):
					</span>

					<input type="hidden" name="totalBarang" value="{{ $subtotal }}">
					<span class="m-text21 w-size20 w-full-sm">
						<input type="text" value="{{ number_format($subtotal) }}">
					</span>
				</div>

				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Berat Total(gram):
					</span>

					<input type="hidden" name="berat" value="{{ $berat }}">
					<span class="m-text21 w-size20 w-full-sm">
						<input type="text" value="{{ number_format($berat) }}">
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

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="kota">
								<option>Pilih Kota Tujuan</option>
								@for($i = 0; $i < count($dataCity); $i++)
									@if($dataCity[$i]["city_id"] == $kota)									
										<option value="{{ $dataCity[$i]['city_name'] }}" selected="selected">{{ $dataCity[$i]['city_name'] }}</option>	
									@endif	
								@endfor
							</select>
						</div>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="provinsi">
								<option>Pilih Provinsi Tujuan</option>
								@for($i = 0; $i < count($dataProv); $i++)
									@if($dataProv[$i]["province_id"] == $prov_idData)
										<option value="{{ $dataProv[$i]['province'] }}" selected="selected">{{ $dataProv[$i]['province'] }}</option>
									@endif		
								@endfor
							</select>
						</div>

						<input class="sizefull s-text7 p-l-15 p-r-15" type="hidden" name="alamat" placeholder="Alamat Tujuan" value="{{ $alamat }}">
						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" disabled="disabled" type="text" placeholder="Alamat Tujuan" value="{{ $alamat }}">
						</div>

						<input class="sizefull s-text7 p-l-15 p-r-15" type="hidden" name="kurir" placeholder="Alamat Tujuan" value="{{ $kurir }}">
						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" disabled="disabled" type="text" value="{{ $kurir }}">
						</div>

						<input type="hidden" name="ongkir" value="{{ $ongkir }}">
						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" disabled="disabled" >
								<option>Pilih Layanan Ongkir</option>
								@for($i = 0; $i < count($dataOngkir); $i++)
									@if($dataOngkir[$i]["cost"]["0"]["value"] == $ongkir)
									<option value="{{ $dataOngkir[$i]["cost"]["0"]["value"] }}" selected="">{{ $dataOngkir[$i]['service'].', estimasi : '.$dataOngkir[$i]["cost"]["0"]["etd"].'hari' }}</option>
									@endif
								@endfor
							</select>
						</div>

						<input class="sizefull s-text7 p-l-15 p-r-15" type="hidden" name="hargaOngkir" placeholder="Alamat Tujuan" value="{{ $ongkir}}">	
						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" disabled="disabled" placeholder="Alamat Tujuan" value="{{ $ongkir}}">
						</div>

						<div class="size14 trans-0-4 m-b-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Update Totals
							</button>
						</div>
					</div>
				</div>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<input type="hidden" name="totalBayar" value="{{ $totalBiaya }}">
					<span class="m-text21 w-size20 w-full-sm">
						Rp.{{ number_format($totalBiaya) }}
					</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Review Order
					</button>
				</div>
			</div>
		</div>
		</form>
	</section>
@endsection
