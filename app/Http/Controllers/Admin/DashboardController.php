<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total'      => Pengajuan::count(),
            'diproses'   => Pengajuan::where('status', 'diproses')->count(),
            'disetujui'  => Pengajuan::where('status', 'disetujui')->count(),
            'pengajuans' => Pengajuan::with([
                'tujuanSurats',
                'tembusanSurats',
                'tujuanKabkotas',
                'berkas'
            ])->latest()->get(),
        ];

        // Jika admin
        if (Auth::user()->role === 'admin') {
            return view('admin.dashboard', $data);
        }

        // Jika super admin
        if (Auth::user()->role === 'super_admin') {
            return view('super_admin.dashboard', $data);
        }

        abort(403);
    }


    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load([
            'tujuanSurats',
            'tembusanSurats',
            'tujuanKabkotas',
            'berkas'
        ]);

        // Admin lihat detail admin view
        if (Auth::user()->role === 'admin') {
            return view('admin.detail', compact('pengajuan'));
        }

        // Super admin lihat detail versi read-only
        if (Auth::user()->role === 'super_admin') {
            return view('super_admin.detail', compact('pengajuan'));
        }

        abort(403);
    }


    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        // 🔐 PROTEKSI PENTING
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang bisa memproses surat.');
        }

        $request->validate([
            'status' => 'required|in:diterima_sistem,diproses,disetujui,ditolak',
        ]);

        $pengajuan->update([
            'status'             => $request->status,
            'verifikasi_data'    => $request->boolean('verifikasi_data'),
            'verifikasi_berkas'  => $request->boolean('verifikasi_berkas'),
        ]);

        return redirect()
    ->route('admin.dashboard')
    ->with('success', 'Status berhasil diubah');
    }
}