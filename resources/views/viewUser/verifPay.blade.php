@extends('viewUser.layout.detailapp')
@section('content')

	<!-- Product Detail -->
	@if($datenow > $timeout->timeout)
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="p-t-33 p-b-60">
				<div class="sec-title p-b-60">
					<h3 class="m-text5 t-center">
						Pembayaran Transaksi Melebihi Batas Waktu
					</h3>
					<h5 class="m-text19 color0-hov trans-0-4 t-center">
						Silakan Melakukan Transaksi Kembali Lain Waktu, dan Bayar Tepat Waktu					
					</h5>
				</div>
			</div>
		</div>
	</section>
			
	@else
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="p-t-33 p-b-60">
				<div class="sec-title p-b-60">
					<h3 class="m-text5 t-center">
						Terimakasih Telah Melakukan Transaksi
					</h3>
					<h5 class="m-text19 color0-hov trans-0-4 t-center">
						Segera lakukan Pembayaran untuk melanjutkan agar segera di proses					
					</h5>
				</div>
			</div>

			<form class="leave-comment" method="POST" enctype="multipart/form-data" action="{{ route('veriv.update', $timeout->id) }}">
				{{ csrf_field() }}
        {{ method_field('PUT') }}
				<div class="container">
					<div class="sec-title p-b-60">
						<div class="t-center">
							<input type="hidden" name="idTrans" value="{{ $timeout->id }}">
							<input class="s-text7 p-l-15 p-r-15 t-center" type="file" name="buktiPembayaran">
							<button type="submit" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4 t-center">
								Upload
							</button>						
						</div>										
					</div>				
				</div>			
			</form>

			<h5 class="m-text19 color0-hov trans-0-4 t-center">
				Upload Bukti Pembayaran Pada Kolom di Atas
			</h5>						
			<h5 class="m-text19 color0-hov trans-0-4 t-center">
				Batas Pembayaran Sampai
			</h5>
			<h3 class="m-text5 t-center">
				{{ $timeout->timeout }}
			</h3>
		</div>		
	</section>
@endif

@endsection

