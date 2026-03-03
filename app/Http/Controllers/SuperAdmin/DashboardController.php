<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with([
            'tujuanSurats',
            'tembusanSurats',
            'tujuanKabkotas',
            'berkas'
        ])->latest()->get();

        $total = $pengajuans->count();
        $diproses = $pengajuans->where('status', 'diproses')->count();
        $disetujui = $pengajuans->where('status', 'disetujui')->count();

        return view('super_admin.dashboard', compact(
            'pengajuans',
            'total',
            'diproses',
            'disetujui'
        ));
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load([
            'tujuanSurats',
            'tembusanSurats',
            'tujuanKabkotas',
            'berkas'
        ]);

        return view('super_admin.detail', compact('pengajuan'));
    }
}