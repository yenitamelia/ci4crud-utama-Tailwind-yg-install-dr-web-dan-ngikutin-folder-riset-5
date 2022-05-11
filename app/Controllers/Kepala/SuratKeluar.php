<?php

namespace App\Controllers\Kepala;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use App\Models\SuratKeluarModel;
use App\Models\DisposisiModel;
use App\Models\GroupsModel;
use App\Models\RoleDisposisiModel;
use CodeIgniter\API\ResponseTrait;
use DateTime;
use PhpParser\Node\Stmt\Echo_;

// use CodeIgniter\I18n\Time;

class SuratKeluar extends BaseController
{
    // protected karena biar bisa dipanggil dikelas ini maupun kelas turunannya
    use ResponseTrait;
    protected $suratModel;
    protected $suratKeluarModel;
    protected $disposisiModel;
    protected $groupsModel;
    protected $roleDisposisiModel;

    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->disposisiModel = new DisposisiModel();
        $this->groupsModel = new GroupsModel();
        $this->roleDisposisiModel = new RoleDisposisiModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel

        $data = [
            'title' => 'Daftar Surat',
            'validation' => \Config\Services::validation(),
            'surat_keluar' => $this->suratKeluarModel->getSuratKeluarKepala(),
            'role' => $this->groupsModel->getGroups(),
            // 'disposisi' => $this->disposisiModel->getDisposisi("id")
        ];

        return view('surat_keluar/index', $data);
    }


    public function modaldisposisikepada()
    {
        $surat_id = $this->request->getGet('surat_id');
        $query = $this->roleDisposisiModel->join('disposisi', 'disposisi.id=role_disposisi.id_disposisi')->join('auth_groups', 'auth_groups.id=role_disposisi.id_role')->where('disposisi.id_surat', $surat_id)->get()->getResultArray();
        return $this->respond($query);
    }

    public function disposisiKepada($id)
    {
        return $this->disposisiModel->getIdRole($id);
    }

    // Bisa aja ngambil dari slug
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Surat',
            'validation' => \Config\Services::validation(),
            'surat' => $this->suratModel->getSurat($id),
            'role' => $this->groupsModel->getGroups()
        ];

        // Jika surat tidak ada di tabel
        if (empty($data['surat'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
        }

        return view('kasubag/detail', $data);
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

    public function create()
    {
        // Pake session agar tampilan errornya muncul
        // Biar ga lupa2 makanya dipindah aja di BaseController
        // session();
        $role = 'durung ngerti';
        $query = "SELECT COUNT(*) AS jumlah FROM `surat` WHERE nomor_agenda Like '3523$role%'";
        dd($query);
        $nomor_agenda = (int) $this->suratModel->query($query)->getRow()->jumlah;


        $data = [
            'title' => 'Form Tambah Surat Masuk',
            'validation' => \Config\Services::validation(),
            'nomor_agenda' => '3523' . $role . '.0' . $nomor_agenda + 1
        ];

        return view('kasubag/create', $data);
    }

    // Berfungsi u/ mengelola data yg dikirim dari create u/ diinsert kedalam tabel
    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nomor_agenda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal_penerimaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tk_keamanan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nomor_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'lampiran' => [
                // Kalau filenya boleh null uploadednya hapus aja
                'rules' => 'uploaded[lampiran]|max_size[lampiran, 2048]|ext_in[lampiran,doc,docx,pdf]',
                'errors' => [
                    // Kalau filenya boleh null uploadednya hapus aja
                    'uploaded' => 'Pilih file terlebih dahulu',
                    'max_size' => 'Ukuran file harus dibawah 2Mb',
                    'ext_in' => 'File hanya boleh berupa doc, docx dan pdf'
                ]
            ]
        ])) {
            // Mengambil pesan kesalahan
            // Ini ngga perlu karena sebenernya udah ada didalam session
            // $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            // return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
            // gaperlu ->with('validation',$validation karena withInput() aja udah cukup)
            return redirect()->to('/Kasubag/Surat/create')->withInput();
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        // Ambil file
        $fileLampiran = $this->request->getFile('lampiran');
        // Pindahkan file ke folder lampiran, masuk ke folder public folder lampiran
        $fileLampiran->move('lampiran');
        // Ambil nama file
        $namaLampiran = $fileLampiran->getName();

        $this->suratModel->save([
            'nomor_agenda' => $this->request->getVar('nomor_agenda'),
            'tanggal_penerimaan' => $this->request->getVar('tanggal_penerimaan'),
            'tk_keamanan' => $this->request->getVar('tk_keamanan'),
            'tanggal_penyelesaian' => $this->request->getVar('tanggal_penyelesaian'),
            'tanggal' => $this->request->getVar('tanggal'),
            'nomor_surat' => $this->request->getVar('nomor_surat'),
            'dari' => $this->request->getVar('dari'),
            'perihal' => $this->request->getVar('perihal'),
            'lampiran' => $namaLampiran,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/Kasubag/Surat');
    }

    public function saveDisposisi()
    {

        $this->suratModel->set('status', '1')->where('id', $this->request->getVar('id_surat'))->update();
        session()->setFlashdata('pesan', 'Surat berhasil didisposisi.');

        return redirect()->to('/kasubag/surat');
    }

    public function delete($id)
    {
        // Cari lampiran berdasarkan id
        $surat = $this->suratModel->find($id);

        // Hapus file lampiran yg ada di folder ci
        // Karena kalau hapus biasa cuman ngehapus sampai phpmyadmin aja, sedangkan di folder ci-nya belum kehapus 
        unlink('lampiran/' . $surat['lampiran']);

        $this->suratModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('surat');
    }

    public function edit($id)
    {
        // Pake session agar tampilan errornya muncul
        // Biar ga lupa2 makanya dipindah aja di BaseController
        // session();
        $data = [
            'title' => 'Form Ubah Surat Masuk',
            'validation' => \Config\Services::validation(),
            // Mengambil semua data surat sesuai id yg dipilih
            'surat' => $this->suratModel->getSurat($id)
        ];

        return view('kasubag/edit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
            'nomor_agenda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal_penerimaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tk_keamanan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nomor_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'lampiran' => [
                // Kalau filenya boleh null uploadednya hapus aja
                'rules' => 'uploaded[lampiran]|max_size[lampiran, 2048]|ext_in[lampiran,doc,docx,pdf]',
                'errors' => [
                    // Kalau filenya boleh null uploadednya hapus aja
                    'uploaded' => 'Pilih file terlebih dahulu',
                    'max_size' => 'Ukuran file harus dibawah 2Mb',
                    'ext_in' => 'File hanya boleh berupa doc, docx dan pdf'
                ]
            ]
        ])) {
            // Mengambil pesan kesalahan
            // Ini ngga perlu karena sebenernya udah ada didalam session
            // $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            // return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
            // gaperlu ->with('validation',$validation karena withInput() aja udah cukup)
            return redirect()->to('/kasubag/surat/edit/' . $id)->withInput();
        }

        // Mengambil file lampiran
        $fileLampiran = $this->request->getFile('lampiran');

        // Cek lampiran, apakah tetap lampiran yg lama
        // Dicek apakah user upload file baru ngga, kalau ngga berarti errornya 4 (filenya kosong)
        if ($fileLampiran->getError() == 4) {
            $namaLampiran = $this->request->getVar('lampiranLama');
        } else {
            // Pindahkan file ke folder lampiran, masuk ke folder public folder lampiran
            $fileLampiran->move('lampiran');
            // Hapus file yang lama
            unlink('lampiran/' . $this->request->getVar['lampiranLama']);
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        $this->suratModel->save([
            'id' => $id,
            'nomor_agenda' => $this->request->getVar('nomor_agenda'),
            'tanggal_penerimaan' => $this->request->getVar('tanggal_penerimaan'),
            'tk_keamanan' => $this->request->getVar('tk_keamanan'),
            'tanggal_penyelesaian' => $this->request->getVar('tanggal_penyelesaian'),
            'tanggal' => $this->request->getVar('tanggal'),
            'nomor_surat' => $this->request->getVar('nomor_surat'),
            'dari' => $this->request->getVar('dari'),
            'perihal' => $this->request->getVar('perihal'),
            'lampiran' => $namaLampiran,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/kasubag/surat');
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
