@extends('viewUser.layout.detailapp')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cartsfoto.jpg') }});">
		<h2 class="l-text2 t-center">
			Review Produk
		</h2>
	</section>

<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">		
		<div class="container">
			<!-- Cart item -->			
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-4">Quantity</th>
							<th class="column-5">Total</th>
							<th class="column-6">Detail</th>
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
									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="{{ $data->qty }}">							
							</td>
							<td class="column-5">Rp.{{ number_format($data->selling_price) }}</td>
							<td class="column-6"><a href="{{ route('pelanggan.inReview', $data->product_id) }}">Review</a></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>		
	</section>
@endsection
