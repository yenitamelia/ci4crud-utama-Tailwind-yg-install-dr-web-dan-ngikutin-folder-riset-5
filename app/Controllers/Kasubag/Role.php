<?php

namespace App\Controllers\Kasubag;

use App\Controllers\BaseController;

use App\Models\SuratModel;
use App\Models\SuratKeluarModel;
use App\Models\GroupsModel;
use App\Models\UserModel;

use DateTime;

class Role extends BaseController
{
    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->groupsModel = new GroupsModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel

        $data = [
            'title' => 'Daftar Surat',
            'surat' => $this->suratModel->getSurat(),
            'surat_keluar' => $this->suratKeluarModel->getSuratKeluar(),
            'users' => $this->userModel->getUser()
        ];

        return view('pages/home', $data);
    }
}
