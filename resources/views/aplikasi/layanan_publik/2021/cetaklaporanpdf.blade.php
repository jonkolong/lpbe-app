<!DOCTYPE html>
<html>
<head>
	<title>Laporan Aplikasi Tahun 2021 {{ $nama_instansi }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 12pt;
			margin: 500px;
		}

	</style>
	<center>
		<p align="center">
			<strong>Aplikasi Pelayanan Publik <br> {{ $nama_instansi }}</Strong><br>
			<strong>Tahun 2021</strong>
		</p>
	</center>
 
	<table class="table table-bordered" width="100%" style="padding:4px;" border="1">
		<thead>
			<tr>
				<th>Nama Aplikasi</th>
				<th>Deskripsi</th>
				<th>Kepemilikan</th>
				<th>Tempat Aplikasi</th>
				<th>Pengguna</th>
			</tr>
		</thead>
		<tbody>
			@if($hitung_aplikasi == 0)
			<tr>
				<td>Nihil</td>
				<td>Nihil</td>
				<td>Nihil</td>
				<td>Nihil</td>
				<td>Nihil</td>
			</tr>
			@else
			@foreach($aplikasi as $p)
			<tr>
				<td>{{ $p->nama_aplikasi }}</td>
				<td>{!! nl2br(e($p->deskripsi)) !!}</td>
				<td>{{ $p->kepemilikan }}</td>
				<td>{{ $p->tempataplikasi }}</td>
				<td>{{ $p->pengguna }}</td>
			</tr>
			@endforeach
			@endif
		</tbody>
	</table>
	<br>
	<br>


		<table border="0">
			<tbody>
				<!-- <tr>
					<td>
						<span>Lubuk Pakam, Agustus 2023</span>
						<br><br><br><br>
					</td>
				</tr>
				<tr>
					<td>{{ $penandatanganan->nama }}</td>
				</tr>
				<tr>
					<td>PEMBINA UTAMA MUDA</td>
				</tr>
				<tr>
					<td>NIP. {{ $penandatanganan->nip }}</td>
				</tr> -->

				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%">{{$penandatanganan->kecamatan->nama_kecamatan}}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%">{{ $penandatanganan->jabatan }} <br>Kabupaten Deli Serdang</td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td class="" width="30%" style="color:#ffffff">#</td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%"></td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%">{{ $penandatanganan->nama }}</td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%">{{ $penandatanganan->pangkat }}</td>
				</tr>
				<tr>
					<td width="20%"></td>
					<td width="20%"></td>
					<td width="30%"></td>
					<td width="30%">NIP. {{ $penandatanganan->nip }}</td>
				</tr>

			</tbody>
		</table>
 
</body>
</html>
