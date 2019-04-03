@extends('viewAdmin.layout.head')
@section('content')

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Input Produk</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Forms</span></li>
								<li><span>Basic</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Input Kategori</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="{{ route('inKategori.store') }}" method="POST">
											@csrf
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Nama Kategori</label>
												<div class="col-md-6">
														@if (session('alert'))
															<div class="alert alert-success">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																<strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
															</div>
														@endif
													<input type="text" class="form-control" id="inputDefault" name="namaKategori">
												</div>
											</div>

											<div class="form-group">
												<div class="col-md-6">
													<button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Submit</button>
													<button type="button" class="mb-xs mt-xs mr-xs btn btn-default">Batal</button>
												</div>
											</div>

										</form>
									</div>
								</section>
								

	@endsection