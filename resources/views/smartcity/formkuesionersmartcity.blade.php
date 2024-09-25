@extends('sidebar.sidebarsmartcitypengguna')
@section('smartcitypengguna')

<!-- Page Title -->
<div class="pagetitle">
	<h1><i class="bi bi-graph-up-arrow"></i> Smart City</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="active ms-1">Kuesioner Smart City</li>
		</ol>
	</nav>
</div>
<!-- End Page Title -->

@php
$i = 1;
@endphp

<div class="card">
	<div class="card-body">
		<form action="{{ route('smartcity.simpan_jawaban') }}" method="post" enctype="multipart/form-data">
			@csrf
			@foreach($pertanyaan as $questions)
			<input type="text" name="instansi_id" value="{{ auth()->user()->instansi_id }}">
			<input type="text" name="pertanyaan_id[]" value="{{ $questions->id }}">
			<div class="form-group mt-3">
				<label>{{ $i++ }}. {{ $questions->pertanyaan }}</label> <br>
				<!-- Perbaikan: Setiap jawaban punya name unik dengan ID pertanyaan -->
				<input type="radio" name="jawaban[{{ $questions->id }}]" value="{{ $questions->pilihan1 }}"> {{ $questions->pilihan1 }} <br>
				<input type="radio" name="jawaban[{{ $questions->id }}]" value="{{ $questions->pilihan2 }}"> {{ $questions->pilihan2 }} <br>
				<input type="radio" name="jawaban[{{ $questions->id }}]" value="{{ $questions->pilihan3 }}"> {{ $questions->pilihan3 }} <br>
				<input type="radio" name="jawaban[{{ $questions->id }}]" value="{{ $questions->pilihan4 }}"> {{ $questions->pilihan4 }} <br>
			</div>
			@endforeach

			<button type="submit" class="btn btn-success mt-3">Simpan</button>
		</form>
	</div>
</div>


@endsection