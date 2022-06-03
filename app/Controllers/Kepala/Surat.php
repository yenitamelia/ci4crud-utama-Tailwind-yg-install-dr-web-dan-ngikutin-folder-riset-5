<?php

namespace App\Controllers\Kepala;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use App\Models\DisposisiModel;
use App\Models\GroupsModel;
use App\Models\UserModel;
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
    protected $roleDisposisiModel;
    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->disposisiModel = new DisposisiModel();
        $this->groupsModel = new GroupsModel();
        $this->userModel = new UserModel();
        $this->roleDisposisiModel = new RoleDisposisiModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel
        $roleId = $this->request->getVar("role");
        $surat = $this->suratModel->getSuratKepala($roleId);

        $data = [
            'title' => 'Daftar Surat',
            'validation' => \Config\Services::validation(),
            'surat' => $surat,
            'role' => $this->groupsModel->getGroups(),
            'users' => $this->userModel->getUserAnggota(),
            // 'disposisi' => $this->disposisiModel->getDisposisi("id")
            'roleId' => $roleId
        ];

        return view('kepala/index', $data);
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

        return view('kepala/detail', $data);
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

        return view('surat/lembar', $data);
    }

    public function saveDisposisi()
    {
        // dd($this->request->getVar());
        // dd($this->request->getFile('gambar'));
        $validation = \Config\Services::validation();
        // validasi input
        if (!$this->validate([
            'isi-disposisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'gambar' => [
                // Kalau filenya boleh null uploadednya hapus aja
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // Kalau filenya boleh null uploadednya hapus aja
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar harus dibawah 1Mb',
                    'is_image' => 'File yang Anda pilih bukan gambar',
                    'mime_in' => 'File yang Anda pilih bukan gambar'
                ]
            ]
        ])) {
        }

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            // Mengambil semua data yg telah diinput
            // $this->request->getVar();
            // $now = new DateTime();
            // dd($now->format('Y-m-d H:i:s'));

            // Ambil file
            $fileGambar = $this->request->getFile('gambar');
            // Pindahkan file ke folder gambar, masuk ke folder public folder gambar
            $fileGambar->move('gambar');
            // Ambil nama file
            $namaGambar = $fileGambar->getName();
            $role = $this->groupsModel->getGroups();



            $query = $this->disposisiModel->save([
                // 'id' => $id,
                'isi_disposisi' => $this->request->getVar('isi-disposisi'),
                'id_surat' => $this->request->getVar('id_surat'),
                'gambar' => $namaGambar,

            ]);
            $insert_id = $this->disposisiModel->getInsertID();

            if ($query) {

                echo json_encode(['code' => 1, 'msg' => 'Data Keterangan Disposisi telah ditambahkan']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Terjadi kesalahan']);
            }

            foreach ($role as $row) {
                if (($row["id"]) > 1) {
                    // dd($this->request->getPost($row["id"]) !== null);
                    $roleDisposisiModel = new RoleDisposisiModel();
                    if ($this->request->getPost($row["id"]) !== null) {
                        $roleDisposisiModel->insert([
                            'id_disposisi' => $insert_id,
                            'id_role' => $row["id"]
                        ]);
                    }
                }
            }

            // $tags = explode(",", $this->request->getVar('tags'));

            // foreach ($tags as $tag) {
            //     $roleDisposisiModel = new RoleDisposisiModel();
            //     $this->roleDisposisiModel->insert([
            //         "id_disposisi" => $insert_id,
            //         "id_user" => $tag,
            //     ]);
            // }
        }
        $this->suratModel->set('disposisi', 1)->where('id', $this->request->getVar('id_surat'))->update();
        session()->setFlashdata('pesan', 'Surat berhasil didisposisi.');

        return redirect()->to('/Kepala/Surat');
    }

    public function download($id)
    {
        $surat = $this->suratModel->find($id);
        return $this->response->download('lampiran/' . $surat['lampiran'], null);
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
