<?php

namespace App\Controllers;

use App\Models\SuratModel;
use DateTime;

// use CodeIgniter\I18n\Time;

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

        // Jika surat tidak ada di tabel
        if (empty($data['surat'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
        }

        return view('surat/detail', $data);
    }

    public function create()
    {
        // Pake session agar tampilan errornya muncul
        // Biar ga lupa2 makanya dipindah aja di BaseController
        // session();
        $data = [
            'title' => 'Form Tambah Surat Masuk',
            'validation' => \Config\Services::validation()
        ];

        return view('surat/create', $data);
    }

    // Berfungsi u/ mengelola data yg dikirim dari create u/ diinsert kedalam tabel
    public function save()
    {
        // validasi input
        if (!$this->validate([
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
            ]
        ])) {
            // Mengambil pesan kesalahan
            $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            return redirect()->to('/surat/create')->withInput()->with('validation', $validation);
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        $this->suratModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'nomor_surat' => $this->request->getVar('nomor_surat'),
            'dari' => $this->request->getVar('dari'),
            'perihal' => $this->request->getVar('perihal'),
            'lampiran' => $this->request->getVar('lampiran'),
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/surat');
    }

    public function delete($id)
    {
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

        return view('surat/edit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
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
            ]
        ])) {
            // Mengambil pesan kesalahan
            $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
        }


        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        $this->suratModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'nomor_surat' => $this->request->getVar('nomor_surat'),
            'dari' => $this->request->getVar('dari'),
            'perihal' => $this->request->getVar('perihal'),
            'lampiran' => $this->request->getVar('lampiran'),
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/surat');
    }
}
