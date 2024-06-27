<?php
 
namespace App\Http\Controllers;
use App\Models\Aplikasi;
use App\Models\CallCenter;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Tahun;
use App\Models\IndikatorSpbe;
use App\Models\Urusan;
use App\Models\BidangUrusan;
use App\Models\Pemberitahuan;
use PDF;
use App\Exports\InstansibelumentriExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuSuperAdminController extends Controller
{
    public function menu(){
        /*$instansi = Instansi::WhereHas('aplikasi', function($q){
                $q->Where('tahun', '2021');
             })->get();*/

        $instansi = Instansi::All();
        $aplikasi_layanan_publik = Aplikasi::Where('jenis_aplikasi', 'Layanan Publik')->Where('tahun', '2021')->count();
        $aplikasi_administrasi_pemerintah = Aplikasi::Where('jenis_aplikasi', 'Administrasi Pemerintah')->Where('tahun', '2021')->count();
        $call_center = CallCenter::Where('tahun', '2021')->count();
        $apspublik_proses = Instansi::WhereHas('aplikasi', function($q){
                $q->Where('jenis_aplikasi', 'Layanan Publik')->Where('tahun', '2021')->Where('status', 'Sedang Proses');
             })->get();
        $apspublik_final = Instansi::WhereHas('aplikasi', function($q){
                $q->Where('jenis_aplikasi', 'Layanan Publik')->Where('tahun', '2021')->Where('status', 'Final');
             })->get();

        $pemberitahuan = Pemberitahuan::orderBy('created_at', 'desc')->limit(3)->get();
        
        return view('superadmin.menu', ['instansi' => $instansi, 'aplikasi_layanan_publik' => $aplikasi_layanan_publik, 'aplikasi_administrasi_pemerintah' => $aplikasi_administrasi_pemerintah, 'call_center' =>$call_center, 'apspublik_proses' =>$apspublik_proses, 'apspublik_final' =>$apspublik_final, 'pemberitahuan' =>$pemberitahuan]);
    }

    public function monevaplikasi_admin(){
        $tahun = request('tahun');
        $tampil_tahun = Tahun::orderBy('tahun', 'asc')->get();

        $aplikasi_layanan_publik_tahun = Aplikasi::where('jenis_aplikasi', 'Layanan Publik')->where('tahun', $tahun)->count();
        $aplikasi_administrasi_pemerintah_tahun = Aplikasi::where('jenis_aplikasi', 'Administrasi Pemerintah')->where('tahun', $tahun)->count();
        $call_center_tahun = CallCenter::where('tahun', $tahun)->count();

        $pemberitahuan = Pemberitahuan::orderBy('created_at', 'desc')->limit(3)->get();
        

        return view('superadmin.monevaplikasi_admin', ['pemberitahuan' =>$pemberitahuan, 'tampil_tahun' => $tampil_tahun, 'aplikasi_layanan_publik_tahun' => $aplikasi_layanan_publik_tahun, 'aplikasi_administrasi_pemerintah_tahun' => $aplikasi_administrasi_pemerintah_tahun, 'call_center_tahun' =>$call_center_tahun, 'tahun' => $tahun]);

    }

    public function datainstansi(){
        $instansi = Instansi::orderBy('nama_instansi', 'asc')->get();
        return view('superadmin.datainstansi', ['instansi' => $instansi]);
    }

    public function tahun(){
        $tahun = Tahun::orderBy('tahun', 'asc')->get();
        return view('superadmin.tahun', ['tahun' => $tahun]);
    }

    public function monitoring(){
    $instansi = Instansi::orderBy('nama_instansi', 'asc')->get();
    $tahun = \App\Models\Tahun::orderBy('tahun', 'asc')->get();
    return view('superadmin.monitoring', ['instansi' => $instansi, 'tahun' => $tahun]);
    }

    public function aplikasi(){
        $instansi = Instansi::orderBy('nama_instansi', 'asc')->get();
        $tahun = \App\Models\Tahun::orderBy('tahun', 'asc')->get();
        $pemberitahuan = Pemberitahuan::orderBy('created_at', 'desc')->limit(3)->get();
        return view('superadmin.aplikasi', ['instansi' => $instansi, 'tahun' => $tahun, 'pemberitahuan' => $pemberitahuan]);
    }

    public function dataopd(){
        $instansi1 = Instansi::WheredoesntHave('aplikasi', function($q){$q->Where('tahun', '2022'); })->get();
        $instansi2 = Instansi::WhereHas('aplikasi', function($q){ $q->Where('status', 'Pending')->Where('tahun', '2022'); })->get();
        $instansi3 = Instansi::WhereHas('aplikasi', function($q){ $q->Where('status', 'Terkirim')->Where('tahun', '2022'); })->get();
        return view('superadmin.dataopd', ['instansi1' => $instansi1, 'instansi2' => $instansi2, 'instansi3' => $instansi3]);
    }

    public function opdbeluminputaplikasi(){
        $tahun = request('tahun');
        $instansi1 = Instansi::WheredoesntHave('aplikasi', function($q){$q->Where('tahun', '2022'); })->get();
        return view('superadmin.opdbeluminputaplikasi', ['instansi1' => $instansi1]);
    }

    public function opdbelumkirim(){
        $instansi1 = $instansi1 = Instansi::doesntHave('aplikasi')->get();
        return view('superadmin.opdbelumkirim', ['instansi1' => $instansi1]);
    }

    public function opdbelumentridataexcel() 
    {
        $instansi1 = Instansi::doesntHave('aplikasi')->get();
        return Excel::download(new InstansibelumentriExport($instansi1), 'Instansi-belum-entri-data.xlsx');
    }

    public function opdbelumentridatapdf(){
        $instansi1 = Instansi::doesntHave('aplikasi')->get();
        $pdf = PDF::loadview('superadmin.tabelbelumkirimpdf',[
            'instansi1'=>$instansi1,
        ])->setPaper('f4', 'landscape');;
        return $pdf->download('laporan-instansi-belum-entridata.pdf');
    }

    public function opdpending(){
        $tahun = request('tahun');
        $instansi2 = Instansi::WhereHas('aplikasi', function($q){ $q->Where('status', 'Pending'); })->get();
        return view('superadmin.opdpending', ['instansi2' => $instansi2]);
    }

    public function opdterkirim(){
        $instansi3 = Instansi::WhereHas('aplikasi', function($q){ $q->Where('status', 'Terkirim'); })->get();
        return view('superadmin.opdterkirim', ['instansi3' => $instansi3]);
    }

    public function daftarindikator(){
    return view('superadmin.daftarindikator');
    }

    public function daftarurusanaplikasiadmpemerintah(){
        $urusanaplikasiadmpemerintah = Urusan::orderBy('nama_urusan', 'asc')->get();
        return view('superadmin.daftarurusanaplikasiadmpemerintah', ['urusanaplikasiadmpemerintah' => $urusanaplikasiadmpemerintah]);
    }

    public function create(){
        return view('urusanaplikasiadmpemerintah.create');
    }

    public function store(Request $request){
        \App\Models\Urusan::create([
            'id' => \Str::Random(8),
            'nama_urusan' => $request->nama_urusan,
        ]);
        return redirect('superadmin/daftarurusanaplikasiadmpemerintah')->with('success', 'Berhasil Menambah Data!');
    }

    public function edit(Urusan $urusanaplikasiadmpemerintah){
        return view('urusanaplikasiadmpemerintah.edit', ['urusanaplikasiadmpemerintah' => $urusanaplikasiadmpemerintah]);
    }

    public function update(Request $request, Urusan $urusanaplikasiadmpemerintah){
             $urusanaplikasiadmpemerintah->update([
                'nama_urusan' => $request->nama_urusan,
            ]);
       
        return redirect('superadmin/daftarurusanaplikasiadmpemerintah')->with('update', 'Berhasil Ubah Data!');
    }

    public function destroy(Request $request, Urusan $urusanaplikasiadmpemerintah){
        $urusanaplikasiadmpemerintah::destroy($urusanaplikasiadmpemerintah->id);
        return redirect('superadmin/daftarurusanaplikasiadmpemerintah')->with('delete', 'Berhasil Menghapus Data!');
    }

    public function daftarbidangurusanaplikasiadmpemerintah($urusan_id){
        $urusan_id = request('urusan_id');
        $bidangurusan1 = BidangUrusan::where('urusan_id', $urusan_id)->get();
        return view('superadmin.daftarbidangurusanaplikasiadmpemerintah', ['urusan_id' => $urusan_id, 'bidangurusan1' => $bidangurusan1]);
    }

    public function createbidangurusan($urusan_id){
        $urusan_id = request('urusan_id');
        $bidangurusan1 = BidangUrusan::where('urusan_id', $urusan_id)->first();

        return view('bidangurusanaplikasiadmpemerintah.create', ['urusan_id' => $urusan_id, 'bidangurusan1' => $bidangurusan1]);
    }

    public function simpanbidangurusan(Request $request){
        \App\Models\BidangUrusan::create([
            'id' => \Str::Random(8),
            'urusan_id' => $request->urusan_id,
            'nama_bidang_urusan' => $request->nama_bidang_urusan,
        ]);
        return redirect('superadmin/daftarbidangurusanaplikasiadmpemerintah/'.$request->urusan_id)->with('success', 'Berhasil Menambah Data!');
    }

    public function editbidangurusan(BidangUrusan $bidangurusan1){
        $urusanaplikasiadmpemerintah = Urusan::orderBy('nama_urusan', 'asc')->get();
        return view('bidangurusanaplikasiadmpemerintah.edit', ['bidangurusan1' => $bidangurusan1], ['urusanaplikasiadmpemerintah' => $urusanaplikasiadmpemerintah]);
    }

    public function updatebidangurusan(Request $request, BidangUrusan $bidangurusan1){
        $bidangurusan1->update([
            'urusan_id' => $request->urusan_id,
            'nama_bidang_urusan' => $request->nama_bidang_urusan,
        ]);
        return redirect('superadmin/daftarbidangurusanaplikasiadmpemerintah/'.$request->urusan_id)->with('update', 'Berhasil Mengubah Data!');
    }

    public function hapusbidangurusan(Request $request, BidangUrusan $bidangurusan1){
        $urusan_id = request('urusan_id');
        $bidangurusan1::destroy($bidangurusan1->id);
        return redirect('superadmin/daftarbidangurusanaplikasiadmpemerintah/'.$bidangurusan1->urusan_id)->with('delete', 'Berhasil Menghapus Data!');
    }
    
}
