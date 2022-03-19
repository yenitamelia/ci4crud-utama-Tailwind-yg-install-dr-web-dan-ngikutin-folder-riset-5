<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\DisposisiModel;
use App\Models\GroupsModel;
use DateTime;
use PhpParser\Node\Stmt\Echo_;

// use CodeIgniter\I18n\Time;

class Tim extends BaseController
{
    // protected karena biar bisa dipanggil dikelas ini maupun kelas turunannya
    protected $suratModel;
    protected $disposisiModel;
    protected $groupsModel;
    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->disposisiModel = new DisposisiModel();
        $this->groupsModel = new GroupsModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel
        // dd(session('id'));
        // dd($this->suratModel->getSuratTim(3));
        // dd($this->groupsModel->getRole(session('id')));
        $role = $this->groupsModel->getRole(session('id'));
        $data = [
            'title' => 'Daftar Surat',
            'validation' => \Config\Services::validation(),
            'surat' => $this->suratModel->getSuratTim($role),
            // 'role' => $this->groupsModel->getGroups()
        ];

        return view('tim/index', $data);
    }
}
