<?php

namespace App\Controllers;

class Kegiatan extends BaseController
{
    public function index()
    {
        if (!session()->get('login')) {
            return redirect()->to('/login');
        }
        $db = \Config\Database::connect();
        $kegiatan = $db->table('kegiatan')->get()->getResult();

        foreach ($kegiatan as $k) {
            $k->foto_tambahan = $db->table('foto_kegiatan')
                ->getWhere(['kegiatan_id' => $k->id])
                ->getResult();
        }

        $data['kegiatan'] = $kegiatan;
        return view('kegiatan/index', $data);
    }

    public function simpan()
    {
        $db = \Config\Database::connect();

        $file = $this->request->getFile('foto');
        $namaFile = null;

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/', $namaFile);
        }

        $db->table('kegiatan')->insert([
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'foto'      => $namaFile
        ]);

        $kegiatanId = $db->insertID();

        $fotos = $this->request->getFiles();
        if (!empty($fotos['foto_tambahan'])) {
            foreach ($fotos['foto_tambahan'] as $f) {
                if ($f->isValid() && !$f->hasMoved()) {
                    $nama = $f->getRandomName();
                    $f->move('uploads/', $nama);
                    $db->table('foto_kegiatan')->insert([
                        'kegiatan_id' => $kegiatanId,
                        'foto'        => $nama
                    ]);
                }
            }
        }

        return $this->response->setJSON(['status' => 'ok']);
    }

    public function update()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getPost('id');

        $file = $this->request->getFile('foto');
        $namaFile = null;

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/', $namaFile);
        }

        $data = [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal')
        ];

        if ($namaFile) {
            $data['foto'] = $namaFile;
        }

        $db->table('kegiatan')->where('id', $id)->update($data);

        $hapusFoto = $this->request->getPost('hapus_foto');
        if (!empty($hapusFoto)) {
            foreach ($hapusFoto as $fotoId) {
                $row = $db->table('foto_kegiatan')->getWhere(['id' => $fotoId])->getRow();
                if ($row && file_exists('uploads/' . $row->foto)) {
                    unlink('uploads/' . $row->foto);
                }
                $db->table('foto_kegiatan')->delete(['id' => $fotoId]);
            }
        }

        $fotos = $this->request->getFiles();
        if (!empty($fotos['foto_tambahan'])) {
            foreach ($fotos['foto_tambahan'] as $f) {
                if ($f->isValid() && !$f->hasMoved()) {
                    $nama = $f->getRandomName();
                    $f->move('uploads/', $nama);
                    $db->table('foto_kegiatan')->insert([
                        'kegiatan_id' => $id,
                        'foto'        => $nama
                    ]);
                }
            }
        }

        return $this->response->setJSON(['status' => 'ok']);
    }

    public function hapus($id)
    {
        $db = \Config\Database::connect();
        $db->table('kegiatan')->delete(['id' => $id]);

        return redirect()->to('/kegiatan');
    }

    public function detail($id)
    {
        $db = \Config\Database::connect();
        $data['kegiatan'] = $db->table('kegiatan')->getWhere(['id' => $id])->getRow();
        $data['foto_tambahan'] = $db->table('foto_kegiatan')->getWhere(['kegiatan_id' => $id])->getResult();
        $data['semua'] = $db->table('kegiatan')->orderBy('tanggal', 'DESC')->limit(4)->get()->getResult();
        return view('kegiatan/detail', $data);
    }
    public function publik()
{
    // Tidak perlu cek session — ini halaman publik
    $db = \Config\Database::connect();
    $kegiatan = $db->table('kegiatan')->orderBy('tanggal', 'DESC')->get()->getResult();

    $data['kegiatan'] = $kegiatan;
    return view('kegiatan/publik', $data); // buat view baru
}
}