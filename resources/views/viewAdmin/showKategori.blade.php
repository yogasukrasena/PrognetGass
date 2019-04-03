@extends('viewAdmin.layout.head')
@section('content')
	<section role="main" class="content-body">
					<header class="page-header">
						<h2>Basic Tables</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Tables</span></li>
								<li><span>Basic</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-md-6">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Basic</h2>
									</header>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table mb-none">
												<thead>
													<tr>
														<th>NO</th>
														<th>Nama Kategori</th>
													</tr>
												</thead>
												<tbody>
													@foreach($tampilKategori as $datas)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{ $datas->category_name }}</td>
														<td class="actions">
															<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
															<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
															{{ csrf_field() }}
															{{ method_field('DELETE') }}
															<a href="" class="on-default edit-row"><i class="fa fa-file-text"></i></a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</div>
						</div>
				<!-- end: page -->
			</section>
		</div>
	@endsection