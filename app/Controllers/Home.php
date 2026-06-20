<?php
namespace App\Controllers;

class Home extends BaseController
{
   public function index()
{
    $db = \Config\Database::connect();
    $anggota = $db->table('anggota')->get()->getRow();
    $data['totalAnggota']  = $anggota->jumlah_anggota ?? 0;
    $data['kegiatan']      = $db->table('kegiatan')->orderBy('tanggal', 'DESC')->limit(3)->get()->getResult();
    $data['totalKegiatan'] = $db->table('kegiatan')->countAll();
    $data['umkm']          = $db->table('umkm')->get()->getResult();
    $data['totalUmkm']     = $db->table('umkm')->countAll();
    return view('Home/index', $data);
}
    public function sejarah()
    {
        return view('Home/sejarah');
    }

    public function visimisi()
    {
        return view('Home/visimisi');
    }

    public function struktur()
    {
        return view('Home/struktur');
    }

    public function anggotaPublik()
    {
        $db = \Config\Database::connect();
        $data['anggota'] = $db->table('anggota')->get()->getResult();
        return view('Home/anggota', $data);
    }

    public function berita()
{
    $db = \Config\Database::connect();
    $data['kegiatan'] = $db->table('kegiatan')->orderBy('tanggal', 'DESC')->get()->getResult();
    return view('Home/berita', $data);
}
    public function umkmPublik()
    {
        $db = \Config\Database::connect();
        $data['umkm'] = $db->table('umkm')->get()->getResult();
        return view('Home/umkm', $data);
    }
    public function events()
{
    $db = \Config\Database::connect();
    $data['events'] = $db->table('events')->orderBy('tanggal', 'DESC')->get()->getResult();
    return view('Home/events', $data);
}

public function eventDetail($id)
{
    $db = \Config\Database::connect();
    $data['event'] = $db->table('events')->getWhere(['id' => $id])->getRow();
    $data['lainnya'] = $db->table('events')->where('id !=', $id)->orderBy('tanggal', 'DESC')->limit(3)->get()->getResult();
    return view('Home/event_detail', $data);
}
}