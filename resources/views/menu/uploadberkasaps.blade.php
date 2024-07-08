@extends('sidebar.sidebarmonevaplikasipengguna')
@section('monevaplikasipengguna')

<div class="pagetitle">
    <h1><i class="bi bi-cpu"></i> Monev Aplikasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="active ms-1">Pendataan Aplikasi</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

@php
$tahun = request('tahun');
$instansi_id = \App\Models\User::where('username', session('username'))->first()->instansi_id;
@endphp
<div class="d-none">{{ $tahun }}</div>
<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            @if($aplikasi || $call_center)
            <div class="alert alert-primary mt-4">Ada data yang belum di finalisasi. Finalisasi Sekarang !!!</div>
            @elseif($aplikasi_final && $call_center_final)
            <div class="card">
                <div class="card-header">
                    Upload berkas anda disini
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.kirimberkas') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="instansi_id" value="{{ $instansi_id }}" class="form-control">
                        <input type="hidden" name="nama" value="Layanan Aplikasi Tahun {{ $tahun }}" class="form-control">
                        <input type="hidden" name="tahun" value="{{ $tahun }}" class="form-control">
                        <div class="form-gorup mt-3">
                            <label>File Aplikasi Layanan Publik</label>
                            <input type="file" name="file_aps_publik" class="form-control" required>
                        </div>
                        <div class="form-gorup mt-3">
                            <label>File Aplikasi Adm. Pemerintahan</label>
                            <input type="file" name="file_aps_pemerintah" class="form-control" required>
                        </div>
                        <div class="form-gorup mt-3">
                            <label>File Layanan Call Center</label>
                            <input type="file" name="file_call_center" class="form-control" required>
                        </div>
                        <div class="form-gorup mt-3">
                            <button class="btn btn-outline-success" type="submit"><i class="bi bi-check-circle"></i> Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="alert alert-primary">Belum tersedia</div>
            @endif
        </div>
    </div>
</section>

@endsection