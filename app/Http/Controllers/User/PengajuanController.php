<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TujuanSurat;
use App\Models\TembusanSurat;
use App\Models\TujuanKabkota;
use App\Models\Berkas;
class PengajuanController extends Controller
{
    public function create()
    {
        return view('user.pengajuan.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'nomor_surat'   => 'required',
        'tanggal_surat' => 'required|date',
        'asal_surat'    => 'required',

        'tujuan'        => 'required|array',
        'kabkota'       => 'required|array',

        'berkas'        => 'required|array',
        'berkas.*'      => 'file|mimes:pdf,jpg,png|max:10000',
    ]);

    $pengajuan = Pengajuan::create([
        'user_id' => Auth::id(),
        'nomor_surat' => $request->nomor_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'asal_surat' => $request->asal_surat,
        'asal_surat_lainnya' =>
            $request->asal_surat === 'Lainnya'
                ? $request->asal_surat_lainnya
                : null,
        'status' => 'diterima_sistem',
    ]);

    // TUJUAN
    foreach ($request->tujuan as $t) {
        $pengajuan->tujuanSurats()->create([
            'nama_tujuan' => $t
        ]);
    }

    // TEMBUSAN (optional)
    foreach ($request->tembusan ?? [] as $t) {
        $pengajuan->tembusanSurats()->create([
            'nama_tembusan' => $t
        ]);
    }

    // KABKOTA
 foreach ($request->kabkota ?? [] as $kab) {
    TujuanKabkota::create([
        'pengajuan_id' => $pengajuan->id,
        'nama_daerah'  => $kab,
    ]);
}


    // BERKAS (multiple)
    foreach ($request->file('berkas') as $file) {
        $path = $file->store('berkas', 'public');

        $pengajuan->berkas()->create([
            'file_path' => $path
        ]);
    }

   return redirect()
    ->route('pengajuan.create')
    ->with('success', 'Surat Anda sudah dikirim. Silakan hubungi pihak terkait untuk informasi lebih lanjut.');

}
}