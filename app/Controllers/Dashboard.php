<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (!session()->get('login')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        // Ambil jumlah anggota dari kolom baru
        $anggota = $db->table('anggota')->get()->getRow();
        $totalAnggota = $anggota->jumlah_anggota ?? 0;

        $totalKegiatan = $db->table('kegiatan')->countAllResults();
        $totalUmkm     = $db->table('umkm')->countAllResults();

        // Bagan struktur aktif
        $bagan = $db->table('struktur_organisasi')
                    ->orderBy('id', 'DESC')
                    ->get(1)->getRow();
        $baganAktif = $bagan->foto ?? null;

        return view('anggota/dashboard', [
            'totalAnggota'  => $totalAnggota,
            'totalKegiatan' => $totalKegiatan,
            'totalUmkm'     => $totalUmkm,
            'baganAktif'    => $baganAktif,
        ]);
    }
}