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
		@foreach($show as $data)
		@if(!empty($review->product_id) and !empty($review->user_id))
			<section class="relateproduct bgwhite p-t-45 p-b-138">
			<div class="container">
				<div class="p-t-33 p-b-60">
					<div class="sec-title p-b-60">
						<h3 class="m-text5 t-center">
							Terima Kasih Telah Memberikan Review Terbaik
						</h3>
						<h5 class="m-text19 color0-hov trans-0-4 t-center">
							Semoga Review Anda dapat menjadi patokan pembeli lain					
						</h5>
					</div>
				</div>
			</div>
		</section>
		@else
		<form action="{{ route('pelanggan.storeReview') }}" method="POST" enctype="multipart/form-data">
		<div class="container">
			{{ csrf_field() }}  
			
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Produk
				</h5>
				
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						<input type="hidden" name="produk_id" value="{{ $data->id }}">
							{{ $data->product_name }}					
					</span>

					<input type="hidden" name="berat" >
					<span class="m-text21 w-size20 w-full-sm">
						<input type="text" >
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Review
					</span>

					<div class="w-size20 w-full-sm">
						<p class="s-text8 p-b-23">
							There are no shipping methods available. Please double check your address, or contact us if you need any help.
						</p>

						<span class="s-text19">
							Masukan Raiting dan Ulasan
						</span>						

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size17 m-t-8 m-b-12">
							<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="rating" value="1" maxlength="5">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
						</div>						
						
						<div class="fullsize bo4 m-b-12">
							<textarea id="street" placeholder="Ulasan" class="form-control" name="ulasan"></textarea>							
						</div>																	

						<div class="size14 trans-0-4 m-b-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
								Review Produk
							</button>
						</div>
					</div>
				</div>
				@endif
			@endforeach

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">					
					</span>

					<input type="hidden" name="totalBayar" >
					<span class="m-text21 w-size20 w-full-sm">						
					</span>
				</div>				
		</div>
		</form>
	</section>
@endsection
