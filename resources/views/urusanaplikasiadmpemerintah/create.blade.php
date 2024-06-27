@extends('sidebar.sidebaradmin')
@section('layout')

<!-- Page Title -->
<div class="pagetitle">
	<h1><i class="bi bi-bar-chart-steps"></i> Urusan</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="active ms-1">Form Data</li>
		</ol>
	</nav>
</div>
<!-- End Page Title -->

<section class="dashboard">
	<div class="row">
		<div class="col-lg-12">
                <div class="card">
					<div class="card-body">
						<form class="mt-3" method="post" action="{{ route('urusanaplikasiadmpemerintah.store') }}" enctype="multipart/form-data">
							@csrf
		                	@method('POST')
							<div class="form-group mb-3">
								<label>Nama Urusan</label>
								<input type="text" name="nama_urusan" class="form-control" value="{{ old('nama_urusan') }}">
							</div>

							<div class="form-group mb-3">
								<button class="btn btn-outline-success btn-icon-split" type="submit">
									<span class="icon">
										<i class="bi bi-check-circle"></i>
									</span>
									<span class="text">Simpan</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>
</section>

@endsection