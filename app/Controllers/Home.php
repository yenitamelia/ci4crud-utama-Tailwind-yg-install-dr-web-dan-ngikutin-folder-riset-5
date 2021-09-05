<?php

namespace App\Controllers;

use App\Models\SuratModel;
use DateTime;

class Home extends BaseController
{
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

        return view('pages/home', $data);
	}
}
