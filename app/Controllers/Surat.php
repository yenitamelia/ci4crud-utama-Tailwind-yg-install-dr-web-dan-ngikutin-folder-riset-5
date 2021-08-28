<?php

namespace App\Controllers;

use App\Models\SuratModel;

class Surat extends BaseController
{
    // protected karena biar bisa dipanggil dikelas ini maupun kelas turunannya
    protected $suratModel;
    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel

        $data = [
            'title' => 'Daftar Surat',
            'surat' => $this->suratModel->getSurat()
        ];

        return view('surat/index', $data);
    }

    // Bisa aja ngambil dari slug
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Surat',
            'surat' => $this->suratModel->getSurat($id)
        ];

        return view('surat/detail', $data);
    }
}
