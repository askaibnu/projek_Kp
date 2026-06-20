<?php

namespace App\Controllers;

class Umkm extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $data['umkm'] = $db->table('umkm')->get()->getResult();

        return view('umkm/index',$data);
    }

   public function simpan()
{
    $db = \Config\Database::connect();

    $file = $this->request->getFile('foto');
    $namaFile = null;

    // HANDLE FOTO
    if ($file && $file->isValid()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/', $namaFile);
    }

    // INSERT DATA
    $insert = $db->table('umkm')->insert([
        'nama_umkm' => $this->request->getPost('nama'),
        'pemilik' => $this->request->getPost('pemilik'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'no_hp'     => $this->request->getPost('no_hp'),
        'harga'     => $this->request->getPost('harga'),   // TAMBAH
        'lokasi'    => $this->request->getPost('lokasi'),  // TAMBAH
        'foto' => $namaFile
    ]);

    // RESPONSE WAJIB
    if ($insert) {
        return $this->response->setJSON(['status' => 'ok']);
    } else {
        return $this->response->setJSON(['status' => 'error']);
    }
}
public function update()
{
    $db = \Config\Database::connect();

    $file = $this->request->getFile('foto');
    $namaFile = null;

    if ($file && $file->isValid()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/', $namaFile);
    }

    $data = [
        'nama_umkm' => $this->request->getPost('nama'),  // DIPERBAIKI
        'pemilik'   => $this->request->getPost('pemilik'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'no_hp'     => $this->request->getPost('no_hp'),  // DITAMBAH
        'harga'     => $this->request->getPost('harga'),   // TAMBAH
        'lokasi'    => $this->request->getPost('lokasi'),  // TAMBAH
        
    ];

    if ($namaFile) {
        $data['foto'] = $namaFile;
    }

    $db->table('umkm')->where('id', $this->request->getPost('id'))->update($data);

    return $this->response->setJSON(['status' => 'ok']);
}

    public function hapus($id)
    {
        $db = \Config\Database::connect();
        $db->table('umkm')->delete(['id'=>$id]);

        return redirect()->to('/umkm');
    }
    
}