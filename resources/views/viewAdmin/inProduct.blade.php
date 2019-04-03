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
						
										<h2 class="panel-title">Input Produk</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" method="POST" action="{{ route('inProduct.store') }}" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												@if (session('alert'))
													<div class="alert alert-success">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
														<strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
													</div>
												@endif
												<label class="col-md-3 control-label" for="inputDefault">Nama Produk</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="inputDefault" name="namaProduk">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Harga Produk</label>
												<div class="col-md-6">
													<input type="number" class="form-control" id="inputDefault" name="hargaProduk">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Jumlah Produk</label>
												<div class="col-md-6">
													<input type="number" class="form-control" id="inputDefault" name="jumlahProduk">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Berat Produk</label>
												<div class="col-md-6">
													<input type="number" class="form-control" id="inputDefault" name="beratProduk">
												</div>
											</div>

												<div class="form-group">
												<label class="col-md-3 control-label">Gambar Produk</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" multiple="multiple" name="gambarProduk[]" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
														</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Raiting Produk</label>
												<div class="col-md-6">
													<input type="number" class="form-control" id="inputDefault" name="raitingProduk">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Kategori Produk</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="kategori">
														<option selected="selected" value="" disabled>Pilih Kategori Barang</option>
														@foreach($showKategori as $datas)
														<option value="{{ $datas->id }}">{{ $datas->category_name }}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Deskripsi Produk</label>
												<div class="col-md-6">
													<textarea class="form-control" rows="3" id="textareaDefault" name="deskripsiProduk"></textarea>
												</div>
											</div>

											<div class="form-group">
												<div class="col-md-6">
													<button type="Submit" class="mb-xs mt-xs mr-xs btn btn-primary">Submit</button>
													<button type="button" class="mb-xs mt-xs mr-xs btn btn-default">Batal</button>
												</div>
											</div>

										</form>
									</div>
								</section>
								

	@endsection