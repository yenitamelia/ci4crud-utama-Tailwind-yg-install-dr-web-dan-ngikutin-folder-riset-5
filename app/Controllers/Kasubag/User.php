<?php

namespace App\Controllers\Kasubag;

use App\Controllers\BaseController;

use App\Models\SuratModel;
use App\Models\SuratKeluarModel;
use App\Models\GroupsModel;
use App\Models\UserModel;

use DateTime;

class User extends BaseController
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
            'title' => 'Daftar Semua User',
            'surat' => $this->suratModel->getSurat(),
            'surat_keluar' => $this->suratKeluarModel->getSuratKeluar(),
            'users' => $this->userModel->getUsers(),
            'groups' => $this->groupsModel->getGroups()
        ];

        return view('kasubag/user', $data);
    }

    public function create()
    {
        // Pake session agar tampilan errornya muncul
        // Biar ga lupa2 makanya dipindah aja di BaseController
        // session();

        $data = [
            'title' => 'Form Tambah Role',
            'validation' => \Config\Services::validation(),
            'groups' => $this->groupsModel->getGroups(),
            'users' => $this->userModel->getUsers()
        ];

        return view('kasubag/userCreate', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'auth_groups_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            // Mengambil pesan kesalahan
            // Ini ngga perlu karena sebenernya udah ada didalam session
            // $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            // return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
            // gaperlu ->with('validation',$validation karena withInput() aja udah cukup)

            // dd($this->request->getVar('nomor_agenda'));
            return redirect()->to('/Kasubag/User/create')->withInput();
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));

        $this->userModel->insert([
            'email' => $this->request->getVar('email'),
            'fullname' => $this->request->getVar('fullname'),
            'auth_groups_id' => $this->request->getVar('auth_groups_id'),
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/Kasubag/User');
    }

    public function edit($id)
    {
        // Pake session agar tampilan errornya muncul
        // Biar ga lupa2 makanya dipindah aja di BaseController
        // session();
        $data = [
            'title' => 'Form Edit User',
            'validation' => \Config\Services::validation(),
            // Mengambil semua data surat sesuai id yg dipilih
            'groups' => $this->groupsModel->getGroups(),
            'users' => $this->userModel->getUser($id)
        ];

        return view('kasubag/userEdit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'auth_groups_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            // Mengambil pesan kesalahan
            // Ini ngga perlu karena sebenernya udah ada didalam session
            // $validation = \Config\Services::validation();
            // Mengirimkan inputan beserta validasinya, inputnya ini dikirim ke session, makanya perlu aktifin session dulu
            // return redirect()->to('/surat/edit/' . $id)->withInput()->with('validation', $validation);
            // gaperlu ->with('validation',$validation karena withInput() aja udah cukup)
            return redirect()->to('/Kasubag/User/edit/' . $id)->withInput();
        }

        // Mengambil semua data yg telah diinput
        // $this->request->getVar();
        $now = new DateTime();
        // dd($now->format('Y-m-d H:i:s'));
        $this->userModel->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'fullname' => $this->request->getVar('fullname'),
            'auth_groups_id' => $this->request->getVar('auth_groups_id'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('Kasubag/User');
    }
}
