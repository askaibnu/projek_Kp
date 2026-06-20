<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestDB extends Controller
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            $db->initialize(); // paksa koneksi

            echo "Koneksi database berhasil!";
        } catch (\Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}