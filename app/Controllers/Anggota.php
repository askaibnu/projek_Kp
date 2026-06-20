<?php

namespace App\Controllers;

class Anggota extends BaseController
{
    public function index()
    {
        if (!session()->get('login')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $data['anggota'] = $db->table('anggota')->get()->getResult();

        return view('anggota/index', $data);
    }

    public function tambah()
    {
        return view('anggota/tambah');
    }

public function simpan()
{
    $db = \Config\Database::connect();
    $jumlah = $this->request->getPost('jumlah_anggota');

    $existing = $db->table('anggota')->get()->getRow();

    if ($existing) {
        $db->table('anggota')->update(['jumlah_anggota' => $jumlah]);
    } else {
        $db->table('anggota')->insert(['jumlah_anggota' => $jumlah]);
    }

    return $this->response->setJSON(['status' => 'ok', 'jumlah' => $jumlah]);
}

public function update()
{
    $db = \Config\Database::connect();
    $data = json_decode(file_get_contents("php://input"), true);

    $db->table('anggota')->where('id',$data['id'])->update([
        'nama'=>$data['nama'],
        'alamat'=>$data['alamat'],
        'no_hp'=>$data['no_hp'],
        'jabatan'=>$data['jabatan'],
        'tanggal_daftar' => $data['tanggal_daftar']
    ]);

    return $this->response->setJSON(['status'=>'ok']);
}
public function simpan_struktur() {
    $foto = $this->request->getFile('foto');
    $namaFoto = $foto->getRandomName();
    $foto->move(WRITEPATH . 'uploads/struktur', $namaFoto);

    $this->db->table('struktur_organisasi')->insert([
        'id_anggota' => $this->request->getPost('id_anggota'),
        'jabatan'    => $this->request->getPost('jabatan'),
        'foto'       => $namaFoto,
    ]);

    return redirect()->to('dashboard')->with('success', 'Struktur berhasil disimpan!');
}
}