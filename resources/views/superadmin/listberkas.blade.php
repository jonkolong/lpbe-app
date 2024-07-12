@extends('sidebar.sidebarberkasapsadmin')
@section('berkasapsadmin')

<!-- Page Title -->
<div class="pagetitle">
    <h1><i class="bi bi-files"></i> Berkas</h1>
</div>
<!-- End Page Title -->

<div class="card">
    <div class="card-body mt-3">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listberkas as $bks)
                @if($bks->posisi == 'Pengguna')
                <tr>
                    <td>{{$bks->nama}}</td>
                    <td>{{$bks->tahun}}</td>
                    <td class="text-center">
                        <a href="{{ route('superadmin.detail_berkas', $bks->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i> Lihat</a>
                    </td>
                </tr>
                @elseif($bks->posisi == 'Admin')
                <tr>
                    <td>{{$bks->nama}}</td>
                    <td>{{$bks->tahun}}</td>
                    <td class="text-center">
                        <a href="{{ route('superadmin.detail_berkas', $bks->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i> Lihat</a>
                        <a href="#" class="btn btn-outline-danger"><i class="bi bi-pencil"></i> Ubah</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection