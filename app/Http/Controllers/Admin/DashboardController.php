<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'total'      => Pengajuan::count(),
            'diproses'   => Pengajuan::where('status', 'diproses')->count(),
            'disetujui'  => Pengajuan::where('status', 'disetujui')->count(),
            'pengajuans' => Pengajuan::with([
                'tujuanSurats',
                'tembusanSurats',
                'tujuanKabkotas',
                'berkas'
            ])->latest()->get(),
        ]);
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load([
            'tujuanSurats',
            'tembusanSurats',
            'tujuanKabkotas',
            'berkas'
        ]);

        return view('admin.detail', compact('pengajuan'));
    }

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $pengajuan->update([
            'status'             => $request->status,
            'verifikasi_data'    => $request->boolean('verifikasi_data'),
            'verifikasi_berkas'  => $request->boolean('verifikasi_berkas'),
        ]);

        return back()->with('success', 'Status berhasil diubah');
    }
}
