<?php
namespace App\Controllers;

class Events extends BaseController
{
    public function index()
    {
        if (!session()->get('login')) {
            return redirect()->to('/login');
        }
        $db = \Config\Database::connect();
        $data['events'] = $db->table('events')->orderBy('tanggal', 'DESC')->get()->getResult();
        return view('events/index', $data);
    }

   public function simpan()
{
    $db = \Config\Database::connect();
    $file = $this->request->getFile('foto');
    $namaFile = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFile = $file->getRandomName();
        $file->move(FCPATH . 'uploads/', $namaFile);
    }

    try {
        $insert = $db->table('events')->insert([
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'lokasi'    => $this->request->getPost('lokasi'),
            'wa_admin'  => $this->request->getPost('wa_admin'),
            'foto'      => $namaFile
        ]);

        if ($insert) {
            return $this->response->setJSON(['status' => 'ok', 'id' => $db->insertID()]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $db->error()['message']]);
        }
    } catch (\Exception $e) {
        return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
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
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'lokasi'    => $this->request->getPost('lokasi'),
            'wa_admin'  => $this->request->getPost('wa_admin'),
        ];

        if ($namaFile) $data['foto'] = $namaFile;

        $db->table('events')->where('id', $this->request->getPost('id'))->update($data);
        return $this->response->setJSON(['status' => 'ok']);
    }

    public function hapus($id)
    {
        $db = \Config\Database::connect();
        $db->table('events')->delete(['id' => $id]);
        return redirect()->to('/admin/events');
    }
}