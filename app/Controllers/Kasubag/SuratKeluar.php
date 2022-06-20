<?php

namespace App\Controllers\Kasubag;

use App\Controllers\BaseController;
use App\Models\SuratModel;
use App\Models\SuratKeluarModel;
use App\Models\SuratKeluarRevisiModel;
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
    protected $suratKeluarRevisiModel;
    protected $disposisiModel;
    protected $groupsModel;
    protected $roleDisposisiModel;

    // Memakai construct supaya manggilnya cukup sekali, karena nnti kalau upddate, delete butuh lagi
    public function __construct()
    {
        // Memanggil/menghubungkan dari file SuratModel
        $this->suratModel = new SuratModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->suratKeluarRevisiModel = new SuratKeluarRevisiModel();
        $this->disposisiModel = new DisposisiModel();
        $this->groupsModel = new GroupsModel();
        $this->roleDisposisiModel = new RoleDisposisiModel();
    }

    public function index()
    {
        // Mengambil semua data dari tabel surat
        // $surat = $this->suratModel->findAll();
        // Diganti dibawah pake method ifelse di file SuratModel
        $role = $this->groupsModel->getRole(session('id'));
        $surats = $this->suratKeluarModel->getSuratKeluarRole($role);
        $data = [
            'title' => 'Daftar Surat Keluar',
            'validation' => \Config\Services::validation(),
            'surat_keluar' => $surats,
            'role' => $this->groupsModel->getGroups(),
            // 'disposisi' => $this->disposisiModel->getDisposisi("id")
        ];

        return view('surat_keluar/index', $data);
    }

    // Bisa aja ngambil dari slug
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Surat',
            'validation' => \Config\Services::validation(),
            'surat_keluar' => $this->suratKeluarModel->getSuratKeluarDetail($id),
            'role' => $this->groupsModel->getGroups()
        ];

        // Jika surat tidak ada di tabel
        if (empty($data['surat_keluar'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
        }

        return view('surat_keluar/detail', $data);
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
        // $role = 'durung ngerti';
        // $query = "SELECT COUNT(*) AS jumlah FROM `surat` WHERE nomor_agenda Like '3523$role%'";
        // dd($query);
        // $nomor_agenda = (int) $this->suratModel->query($query)->getRow()->jumlah;


        $data = [
            'title' => 'Form Tambah Surat Keluar',
            'validation' => \Config\Services::validation(),
            'nomor_urut' => 'B.3523',
            // 'nomor_agenda' => '3523' . $role . '.0' . $nomor_agenda + 1
        ];

        return view('surat_keluar/create', $data);
    }

    public function getNomorUrut()
    {
        // $role = $this->request->getGet('role');
        // $query = $this->suratModel
        //     ->like('nomor_agenda', '3523' . $role)
        //     ->countAllResults();
        // return $this->respond($query);
        // B35230.001.A

        $isLate = $this->request->getGet('isLate');
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        if ($isLate == 'false') {
            $query = $this->suratKeluarModel->getNomorUrut();
            $nomor_urut = $query[0]['nomor_urut'];
            return $this->respond('00' . substr($nomor_urut, 9, 1) + 1);
        } else {
            $query = $this->suratKeluarModel->getNomorUrut($tahun, $bulan);
            $nomor_urut = $query[0]['nomor_urut'];
            $abjadableChar = substr($nomor_urut, 11, 1);
            $lateSuratFound = ctype_alpha($abjadableChar);
            $abjadUsed = $lateSuratFound ? chr(ord($abjadableChar) + 1) : '.A';
            $usedLength = $lateSuratFound ? 4 : 3;
            $result = substr($nomor_urut, 7, $usedLength) . $abjadUsed;
            return $this->respond($result);
        }
    }

    // Berfungsi u/ mengelola data yg dikirim dari create u/ diinsert kedalam tabel
    public function saveSuratKeluar()
    {
        // validasi input

        if (!$this->validate([
            'nomor_urut' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat' => [
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
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'lampiran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nomor_petunjuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'file_keluar' => [
                // Kalau filenya boleh null uploadednya hapus aja
                'rules' => 'max_size[file_keluar, 2048]|ext_in[file_keluar,pdf]',
                'errors' => [
                    // Kalau filenya boleh null uploadednya hapus aja
                    'max_size' => 'Ukuran file harus dibawah 2Mb',
                    'ext_in' => 'File hanya boleh berupa pdf'
                ]
            ]
        ])) {
            // Mengambil pesan kesalahan
            // Ini ngga perlu karena sebenernya udah ada didalam session
            // $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            // return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
            // gaperlu ->with('validation',$validation karena withInput() aja udah cukup)

            return redirect()->to('/Kasubag/SuratKeluar/create')->withInput();
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        // Ambil file
        $fileLampiran = $this->request->getFile('file_keluar');
        // Ambil nama file
        $namaLampiran =  str_replace("/", "", $this->request->getVar('nomor_urut')) . ' ' . $fileLampiran->getName();
        // Pindahkan file ke folder lampiran, masuk ke folder public folder lampiran
        $fileLampiran->move('file_keluar', $namaLampiran);

        $this->suratKeluarModel->insert([
            'role' => $this->request->getVar('id_role'),
            'nomor_urut' => $this->request->getVar('nomor_urut'),
            'alamat' => $this->request->getVar('alamat'),
            'perihal' => $this->request->getVar('perihal'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
            'lampiran' => $this->request->getVar('lampiran'),
            'nomor_petunjuk' => $this->request->getVar('nomor_petunjuk'),
            'keterangan' => $this->request->getVar('keterangan'),
            'file_keluar' => $namaLampiran,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/Kasubag/SuratKeluar');
    }

    public function delete($id)
    {
        // Cari lampiran berdasarkan id
        $surat_keluar = $this->suratKeluarModel->find($id);

        // Hapus file lampiran yg ada di folder ci
        // Karena kalau hapus biasa cuman ngehapus sampai phpmyadmin aja, sedangkan di folder ci-nya belum kehapus 
        unlink('file_keluar/' . $surat_keluar['file_keluar']);

        $this->suratKeluarModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('suratKeluar');
    }

    public function edit($id)
    {
        // Pake session agar tampilan errornya muncul
        // Biar ga lupa2 makanya dipindah aja di BaseController
        // session();
        $data = [
            'title' => 'Form Ubah Surat Keluar',
            'validation' => \Config\Services::validation(),
            // Mengambil semua data surat sesuai id yg dipilih
            'surat_keluar' => $this->suratKeluarModel->getSuratKeluarDetail($id),
        ];

        return view('surat_keluar/edit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
            'alamat' => [
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
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'lampiran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'nomor_petunjuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'file_keluar' => [
                // Kalau filenya boleh null uploadednya hapus aja
                'rules' => 'max_size[file_keluar, 2048]|ext_in[file_keluar,pdf]',
                'errors' => [
                    // Kalau filenya boleh null uploadednya hapus aja
                    'max_size' => 'Ukuran file harus dibawah 2Mb',
                    'ext_in' => 'File hanya boleh berupa pdf'
                ]
            ]

        ])) {
            // Mengambil pesan kesalahan
            // Ini ngga perlu karena sebenernya udah ada didalam session
            // $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            // return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
            // gaperlu ->with('validation',$validation karena withInput() aja udah cukup)
            return redirect()->to('/Kasubag/SuratKeluar/edit/' . $id)->withInput();
        }

        // Mengambil file lampiran
        $fileLampiran = $this->request->getFile('file_keluar');
        // Ambil nama file
        $namaLampiran =  str_replace("/", "", $this->request->getVar('nomor_urut')) . ' ' . $fileLampiran->getName();
        // Cek lampiran, apakah tetap lampiran yg lama
        // Dicek apakah user upload file baru ngga, kalau ngga berarti errornya 4 (filenya kosong)
        if ($fileLampiran->getError() == 4) {
            $namaLampiran = $this->request->getVar('file_keluarLama');
        } else {
            if (is_file('file_keluar/' . $this->request->getVar('file_keluarLama'))) {
                // Hapus file yang lama
                unlink('file_keluar/' . $this->request->getVar('file_keluarLama'));
            }
            // Pindahkan file ke folder lampiran, masuk ke folder public folder lampiran
            $fileLampiran->move('file_keluar/', $namaLampiran);
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        $this->suratKeluarModel->save([
            'id' => $id,
            'nomor_urut' => $this->request->getVar('nomor_urut'),
            'alamat' => $this->request->getVar('alamat'),
            'perihal' => $this->request->getVar('perihal'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
            'lampiran' => $this->request->getVar('lampiran'),
            'nomor_petunjuk' => $this->request->getVar('nomor_petunjuk'),
            'keterangan' => $this->request->getVar('keterangan'),
            'file_keluar' => $namaLampiran,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/Kasubag/SuratKeluar');
    }

    public function download($id)
    {
        $surat_keluar = $this->suratKeluarModel->find($id);
        return $this->response->download('file_keluar/' . $surat_keluar['file_keluar'], null);
    }

    public function modalRevisi()
    {
        $surat_id = $this->request->getGet('surat_id');
        // $query = $this->roleDisposisiModel->join('disposisi', 'disposisi.id=role_disposisi.id_disposisi')->join('role', 'role.id=role_disposisi.id_role')->where('disposisi.id_surat', $surat_id)->get()->getResultArray();
        $query = $this->suratKeluarRevisiModel->join('surat_keluar', 'surat_keluar.id=surat_keluar_revisi.id_surat_keluar')->where('surat_keluar_revisi.id_surat_keluar', $surat_id)->get()->getResultArray();
        return $this->respond($query);
    }

    public function mintaPersetujuan()
    {
        $this->suratKeluarModel->set('status_pengiriman', '1')->where('id', $this->request->getVar('id_surat'))->update();
        session()->setFlashdata('pesan', 'Surat berhasil dikirim untuk meminta persetujuan.');

        return redirect()->to('/Kasubag/SuratKeluar');
    }

    public function saveUploadRevisi()
    {
        // validasi input
        if (!$this->validate([
            'file_keluar' => [
                // Kalau filenya boleh null uploadednya hapus aja
                'rules' => 'max_size[file_keluar, 2048]|ext_in[file_keluar,pdf]',
                'errors' => [
                    // Kalau filenya boleh null uploadednya hapus aja
                    'max_size' => 'Ukuran file harus dibawah 2Mb',
                    'ext_in' => 'File hanya boleh berupa pdf'
                ]
            ]

        ])) {
        }

        // Mengambil file lampiran
        $fileLampiran = $this->request->getFile('file_keluar');
        // Ambil nama file
        $namaLampiran = str_replace("/", "", $this->request->getVar('nomor_urut')) . ' ' . $fileLampiran->getName();

        // Pindahkan file ke folder lampiran, masuk ke folder public folder lampiran
        $fileLampiran->move('file_keluar/', $namaLampiran);

        $this->suratKeluarModel->set(['status_revisi' => 0, 'file_keluar' => $namaLampiran])
            ->where('id', $this->request->getVar('surat_id'))->update();

        session()->setFlashdata('pesan', 'Revisi surat berhasil dikirim.');

        return redirect()->to('/Kasubag/SuratKeluar');
    }

    public function downloadttd($id)
    {
        $surat_keluar = $this->suratKeluarModel->find($id);
        $this->suratKeluarModel->set('status_download', '1')->where('id', $id)->update();
        return $this->response->download('gambar/' . $surat_keluar['tanda_tangan'], null);
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
