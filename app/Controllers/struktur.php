<?php

namespace App\Controllers;

class Struktur extends BaseController
{
    public function upload()
    {
        $foto = $this->request->getFile('gambar_bagan');

        if (!$foto || !$foto->isValid()) {
            return redirect()->to('/dashboard')->with('error', 'File tidak valid');
        }

        $namaFoto = $foto->getRandomName();
        $foto->move(FCPATH . 'uploads/struktur/', $namaFoto);

        $db = \Config\Database::connect();
        $db->table('struktur_organisasi')->insert([
            'foto' => $namaFoto,
        ]);

        return redirect()->to('/dashboard')->with('success', 'Bagan berhasil disimpan!');
    }
}