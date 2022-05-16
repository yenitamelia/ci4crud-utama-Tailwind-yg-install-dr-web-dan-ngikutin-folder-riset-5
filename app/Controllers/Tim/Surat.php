<?php

namespace App\Controllers\Tim;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use App\Models\DisposisiModel;
use App\Models\GroupsModel;
use App\Models\UserModel;
use App\Models\RoleDisposisiModel;
use App\Models\DisposisiUserModel;
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
    protected $roleDisposisiModel;
    protected $disposisiUserModel;
    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->disposisiModel = new DisposisiModel();
        $this->groupsModel = new GroupsModel();
        $this->userModel = new UserModel();
        $this->roleDisposisiModel = new RoleDisposisiModel();
        $this->disposisiUserModel = new DisposisiUserModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel

        $role = $this->groupsModel->getRole(session('id'));
        $surats = $this->suratModel->getSuratTim($role);

        $disposisiIds = [];
        foreach ($surats as $surat) {
            array_push($disposisiIds, $surat['id_disposisi']);
        }


        $disposisiIdsDiserahkan = $this->disposisiUserModel->getByDisposisiIdsDistinct($disposisiIds);
        $disposisiMap = array();
        foreach ($disposisiIdsDiserahkan as $disposisiIdDiserahkan) {
            $disposisiMap[$disposisiIdDiserahkan['id_disposisi']] = true;
        }

        for ($i = 0; $i < count($surats); $i++) {
            if (isset($disposisiMap[$surats[$i]['id_disposisi']])) {
                $surats[$i]['sudah_diteruskan'] = true;
            } else {
                $surats[$i]['sudah_diteruskan'] = false;
            }
        }

        $data = [
            'title' => 'Daftar Surat',
            'validation' => \Config\Services::validation(),
            'surat' => $surats,
            'role' => $this->groupsModel->getGroups(),
            'users' => $this->userModel->getUsersByRoleId(8)
        ];

        return view('tim/index', $data);
    }

    // Bisa aja ngambil dari slug
    public function detail($id)
    {
        $query = $this->roleDisposisiModel->join('disposisi', 'disposisi.id=role_disposisi.id_disposisi')->join('auth_groups', 'auth_groups.id=role_disposisi.id_role')->where('disposisi.id_surat', $id)->get()->getResultArray();
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

        return view('tim/detail', $data);
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

        return view('tim/lembar', $data);
    }

    public function download($id)
    {
        $surat = $this->suratModel->find($id);
        return $this->response->download('lampiran/' . $surat['lampiran'], null);
    }

    public function saveTandai()
    {
        $validation = \Config\Services::validation();
        // validasi input
        if (!$this->validate([
            'tags' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'id_disposisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]

        ])) {
        }

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            $id_disposisi = $this->request->getVar('id_disposisi');
            $tags = explode(",", $this->request->getVar('tags'));

            foreach ($tags as $tag) {
                $this->disposisiUserModel->save([
                    "id_disposisi" => $id_disposisi,
                    "id_user" => $tag,
                ]);
            }
        }

        session()->setFlashdata('pesan', 'Surat berhasil didisposisi.');

        return redirect()->to('/tim/surat');
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
