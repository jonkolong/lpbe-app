@extends('sidebar.sidebarpengguna')
@section('layout')


<!-- Page Title -->
<div class="pagetitle">
    <h1><i class="bi bi-file-earmark-pdf"></i> Panduan Penggunaan Aplikasi SPBE</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="active ms-1"><i class="bi bi-steam"></i> Layanan Pemerintah Berbasis Elektronik</li> -->
            </ol>
        </nav>
</div>
<!-- End Page Title -->

<div class="card gradient">
    <div class="card-body">
        <p class="mt-3">
            Berikut ini adalah cara penggunaan dan pengelolaan aplikasi monev SPBE: <br>
            <div class="mt-3">
                1. Pengguna harus login terlebih dahulu dengan memasukkan username dan password yang telah diberikan oleh Dinas Komunikasi, Informatika, Statistik, dan Persandian Kabupaten Deli Serdang. <br>
                <img src="{{ url('/')}}/konten/panduan/login.png" class="w-100" alt="">
            </div>
            <div class="mt-3">
                2. Pengguna dapat melihat jumlah data layanan pada menu dashboard. <br>
                <img src="{{ url('/')}}/konten/panduan/dashboard.png" class="w-100" alt="">
            </div>
            <div class="mt-3">
                3. Selanjutnya masuk ke menu Monev Aplikasi, pilih layanan beserta tahun yang tersedia. <br>
                <img src="{{ url('/')}}/konten/panduan/layanan.png" class="w-100" alt="">
            </div>
            <div class="mt-3">
                4. Pada Halaman layanan yang dituju, tekan tambah data pada agar anda diarahkan pada form pengisian data. lakukan pengisian data dengan benar dan tepat, lalu tekan simpan. <br>
                <img src="{{ url('/')}}/konten/panduan/form_isi_data_layanan_aplikasi.png" class="w-100" alt="">
            </div>
            <div class="mt-3">
                5. Setelah selesai mendata layanan, tekan tombol finalisasi agar data layanan yang anda entri terkirim ke admin. Sebelumnya pastikan bahwa data yang anda isikan adalah data yang benar dan tepat. Tekan lihat untuk menampilkan detail data dan tekan edit untuk mengubah data. <br>
                <img src="{{ url('/')}}/konten/panduan/data.png" class="w-100" alt="">
            </div>
            <div class="mt-3">
                6. Setelah finalisasi anda akan diarahkan pada halaman data yang sudah di finalisasi secara otomatis. Silahkan menunggu admin dari dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Deli Serdang untuk diverifikasi.<br>
                <img src="{{ url('/')}}/konten/panduan/finalisasi.png" class="w-100" alt="">
            </div>
        </p>
    </div>
</div>



@endsection