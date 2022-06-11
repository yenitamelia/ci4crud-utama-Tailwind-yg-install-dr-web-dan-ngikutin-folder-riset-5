<?php

namespace App\Controllers\AnggotaTim;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use App\Models\DisposisiModel;
use App\Models\GroupsModel;
use App\Models\UserModel;
use App\Models\DisposisiUserModel;
use App\Models\RoleDisposisiModel;
use DateTime;
use PhpParser\Node\Stmt\Echo_;

// use CodeIgniter\I18n\Time;

class Surat extends BaseController
{
    // protected karena biar bisa dipanggil dikelas ini maupun kelas turunannya
    protected $suratModel;
    protected $disposisiModel;
    protected $groupsModel;
    protected $userModel;
    protected $disposisiUserModel;
    protected $roleDisposisiModel;
    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->disposisiModel = new DisposisiModel();
        $this->groupsModel = new GroupsModel();
        $this->userModel = new UserModel();
        $this->disposisiUserModel = new DisposisiUserModel();
        $this->roleDisposisiModel = new RoleDisposisiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Surat',
            'validation' => \Config\Services::validation(),
            'surat' => $this->disposisiUserModel->getByUserId(session('id')),
            'role' => $this->groupsModel->getGroups(),
            'users' => $this->userModel->getUser()
        ];

        return view('anggotaTim/index', $data);
    }

    // Bisa aja ngambil dari slug
    public function detail($id)
    {
        $query = $this->disposisiUserModel->join('disposisi', 'disposisi.id=disposisi_user.id_disposisi')->join('users', 'users.id=disposisi_user.id_user')->join('role', 'role.id=users.role_id')->where('disposisi.id_surat', $id)->get()->getResultArray();
        $data = [
            'title' => 'Detail Surat',
            'validation' => \Config\Services::validation(),
            'surat' => $this->suratModel->getSurat($id),
            'role' => $query,
            'disposisi' => $this->disposisiModel->where('id_surat', $id)->first()
        ];

        // Jika surat tidak ada di tabel
        if (empty($data['surat'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
        }

        return view('anggotaTim/detail', $data);
    }

    public function lembar($id)
    {
        $data = [
            'title' => 'Lembar Surat',
            'surat' => $this->suratModel->getSurat($id)
        ];

        // Jika surat tidak ada di tabel
        if (empty($data['surat'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
        }

        return view('anggotaTim/lembar', $data);
    }

    public function download($id)
    {
        $surat = $this->suratModel->find($id);
        return $this->response->download('file_masuk/' . $surat['file_masuk'], null);
    }

    // public function read($id)
    // {
    //     $surat = $this->suratModel->find($id);
    //     // return $surat['lampiran'];
    //     // $lampiran = $surat["lampiran"];
    //     // $len = isset($lampiran) ? count($lampiran) : 0;
    //     // dd($len);
    //     // echo '<iframe src= "DAFTAR_ST2013_L (1)_1.pdf"</iframe>';
    //     echo 'DAFTAR_ST2013_L (1)_1.pdf';
    // }

    // public function viewpdf($id)
    // {
    //     // Mengambil semua data dari tabel surat
    //     // $surat = $this->suratModel->findAll();
    //     // Diganti dibawah pake method ifelse di file SuratModel

    //     $data = [
    //         'title' => 'View Surat',
    //         'validation' => \Config\Services::validation(),
    //         'surat' => $this->suratModel->getSurat($id)
    //     ];

    //     // Jika surat tidak ada di tabel
    //     if (empty($data['surat'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
    //     }

    //     return view('surat/viewpdf', $data);
    // }
}
