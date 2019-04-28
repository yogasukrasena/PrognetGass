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
										<form class="form-horizontal form-bordered" method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												@if (session('alert'))
													<div class="alert alert-success">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
														<strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
													</div>
												@endif
												<label class="col-md-3 control-label" for="inputDefault">Username</label>
												<div class="col-md-6">
													<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
													@if ($errors->has('username'))
					                    <span class="invalid-feedback" role="alert">
					                        <strong>{{ $errors->first('username') }}</strong>
					                    </span>
					               @endif
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Nama</label>
												<div class="col-md-6">
													<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
													 @if ($errors->has('name'))
						                    <span class="invalid-feedback" role="alert">
						                        <strong>{{ $errors->first('name') }}</strong>
						                    </span>
						               @endif
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Phone</label>
												<div class="col-md-6">
													<input id="phone" type="number" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
													 @if ($errors->has('phone'))
					                    <span class="invalid-feedback" role="alert">
					                        <strong>{{ $errors->first('phone') }}</strong>
					                    </span>
					                 @endif
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Password</label>
												<div class="col-md-6">
													<input id="password" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
													@if ($errors->has('password'))
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $errors->first('password') }}</strong>
			                        </span>
			                    @endif
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Password Confirmation</label>
												<div class="col-md-6">
													<input id="password-confirm" type="password" class="form-control  " name="password_confirmation" required>
												</div>
											</div>

												<div class="form-group">
												<label class="col-md-3 control-label">Photo Profile</label>
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
																<input type="file" multiple="multiple" name="profileimage" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
														</div>
													</div>
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