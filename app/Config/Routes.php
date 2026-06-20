<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);

// AUTH
$routes->get('login', 'Auth::login');
$routes->post('login/proses', 'Auth::prosesLogin');
$routes->get('logout', 'Auth::logout');

// DASHBOARD
$routes->get('dashboard', 'Dashboard::index');
$routes->post('admin/upload-struktur', 'Dashboard::uploadStruktur');

// ANGGOTA
$routes->get('anggota', 'Anggota::index');
$routes->post('anggota/simpan', 'Anggota::simpan');
$routes->post('anggota/update', 'Anggota::update');
$routes->get('anggota/hapus/(:num)', 'Anggota::hapus/$1');

// KEGIATAN ADMIN
$routes->get('admin/kegiatan', 'Kegiatan::index');
$routes->post('admin/kegiatan/simpan', 'Kegiatan::simpan');
$routes->post('admin/kegiatan/update', 'Kegiatan::update');
$routes->get('admin/kegiatan/hapus/(:num)', 'Kegiatan::hapus/$1');

// KEGIATAN PUBLIK
$routes->get('kegiatan', 'Kegiatan::publik');
$routes->get('kegiatan/detail/(:num)', 'Kegiatan::detail/$1');

// UMKM
$routes->get('umkm', 'Umkm::index');
$routes->post('umkm/simpan', 'Umkm::simpan');
$routes->post('umkm/update', 'Umkm::update');
$routes->get('umkm/hapus/(:num)', 'Umkm::hapus/$1');

// PUBLIC PAGES
$routes->get('/', 'Home::index');
$routes->get('profil/sejarah', 'Home::sejarah');
$routes->get('profil/visimisi', 'Home::visimisi');
$routes->get('profil/struktur', 'Home::struktur');
$routes->get('berita', 'Home::berita');
$routes->get('umkm-publik', 'Home::umkmPublik');

// EVENT
$routes->get('events', 'Home::events');
$routes->get('admin/events', 'Events::index');
$routes->post('admin/events/simpan', 'Events::simpan');
$routes->post('admin/events/update', 'Events::update');
$routes->get('admin/events/hapus/(:num)', 'Events::hapus/$1');
$routes->get('events/detail/(:num)', 'Home::eventDetail/$1');

// STRUKTUR ORGANISASI
$routes->get('struktur', 'Struktur::index');
$routes->post('struktur/simpan', 'Struktur::simpan');
$routes->post('struktur/upload', 'Struktur::upload');