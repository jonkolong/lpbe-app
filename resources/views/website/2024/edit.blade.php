@extends('sidebar.sidebarmonevaplikasipengguna')
@section('monevaplikasipengguna')

<div class="pagetitle">
	<h1><i class="bi bi-cpu"></i> Monev Aplikasi</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="active ms-1">Website</li>
		</ol>
	</nav>
</div>
<!-- End Page Title -->


<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('website.2024.edit', ['website' => $website]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id">
                        <input type="hidden" name="tahun" value="2024">
                        <input type="hidden" name="instansi_id" class="form-control" value=" {{ \App\Models\User::where('username', session('username'))->first()->instansi_id }}" readonly>
                        <div class="form-group mt-3">
                            <label>Nama Website</label>
                            <input type="text" name="nama_website" value="{{ $website->nama_website }}" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Deskripsi Website</label>
                            <textarea name="deskripsi_website" class="form-control">{{ $website->deskripsi_website }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label>Alamat URL</label>
                            <input type="url" name="url" class="form-control" value="{{ $website->url }}" required>
                            <sup><em>Contoh: <span class="fw-bold text-danger">https://</span>deliserdangkab.go.id</em></sup>
                        </div>
                        <div class="form-group mt-3">
                            <label>Pengembang</label>
                            <select name="pengembang" class="form-control" required>
                                <option value="{{$website->pengembang}}">{{ $website->pengembang }}</option>
                                <option value="Dikembangkan Sendiri">Dikembangkan Sendiri</option>
                                <option value="Dinas Komunikasi, Informatika, Statistik dan Persandian">Dinas Komunikasi, Informatika, Statistik dan Persandian</option>
                                <option value="Pihak Ketiga">Pihak Ketiga</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label>Tempat</label>
                            <select name="tempat" class="form-control" required>
                                <option value="{{ $website->tempat }}">{{ $website->tempat }}</option>
                                <option value="Unit Kerja Terkait">Unit Kerja Terkait</option>
                                <option value="Dinas Komunikasi, Informatika, Statistik dan Persandian">Dinas Komunikasi, Informatika, Statistik dan Persandian</option>
                                <option value="Pihak Ketiga">Pihak Ketiga</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
							<label>Apakah Website ini menyimpan data pribadi/rahasia ?</label>
							<div>
								<input type="radio" name="rahasia" id="ya" value="ya" {{ $website->rahasia === 'ya' ? 'checked' : '' }} required> Ya
							</div>
							<div>
								<input type="radio" name="rahasia" id="tidak" value="tidak" {{ $website->rahasia === 'tidak' ? 'checked' : '' }} required> Tidak
							</div>
						</div>
                        <div class="form-group mt-3">
                            <label>Apakah Website ini menyediakan fitur ramah anak ?</label>
                            <div>
								<input type="radio" name="ramah_anak" id="ya" value="ya" {{ $website->ramah_anak === 'ya' ? 'checked' : '' }} required> Ya
							</div>
							<div>
								<input type="radio" name="ramah_anak" id="tidak" value="tidak" {{ $website->ramah_anak === 'tidak' ? 'checked' : '' }} required> Tidak
							</div>
                        </div>
                        <div class="row mt-3">
	                    	<div class="col-lg-4">
	                    		<div class="form-group">
	                    			<label>Nama PIC</label>
	                    			<div>
	                    				<input type="text" name="nama_pic" class="form-control" value="{{ $website->nama_pic }}" required>
	                    			</div>
	                    		</div>
	                    	</div>
	                    	<div class="col-lg-4">
	                    		<div class="form-group">
	                    			<label>Jabatan</label>
	                    			<div>
	                    				<input type="text" name="jabatan_pic" class="form-control" value="{{ $website->jabatan_pic }}" required><br />
	                    			</div>
	                    		</div>
	                    	</div>
	                    	<div class="col-lg-4">
	                    		<div class="form-group">
	                    			<label>No. Handphone</label>
	                    			<div>
	                    				<input type="number" name="kontak" class="form-control" value="{{ $website->kontak }}" required>
	                    			</div>
	                    		</div>
	                    	</div>
	                    </div>
                        <button class="btn btn-outline-success btn-icon-split" id="submitButton">
	                    	<span class="icon">
	                    		<i class="bi bi-check2-circle"></i>
	                    	</span>
	                    	<span class="text">Simpan</span>
	                    </button>
	                    <a href="#" class="btn btn-outline-danger btn-icon-split"  data-bs-toggle="modal" data-bs-target="#Modal">
	                    	<span class="icon">
	                    		<i class="bi bi-trash"></i>
	                    	</span>
	                    	<span class="text">Hapus</span>
	                    </a>
                    </form>
                    <!-- Modal Hapus Data -->
					<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									Apakah anda yakin menghapus data ini ?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button> 
									<form method="post" action="{{ route('website.2024.delete', $website->id) }}" enctype="multipart/form-data">
										@csrf
										@method('DELETE')
										<input type="hidden" name="id">
										<input type="hidden" name="tahun" value="{{ $website->tahun }}">
										<button type="submit" class="btn btn-sm btn-outline-primary btn-icon-split">
											<i class="bi bi-check2-circle"></i> <span class="text">Lanjutkan</span>
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- akhir modal hapus data -->
                </div>
            </div>
        </div>
    </div>
</section>



@endsection