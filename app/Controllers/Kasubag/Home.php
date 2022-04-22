<?php

namespace App\Controllers\Kasubag;

use App\Controllers\BaseController;

use App\Models\SuratModel;
use App\Models\SuratKeluarModel;
use App\Models\GroupsModel;
use App\Models\UserModel;

use DateTime;

class Home extends BaseController
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

		$count = [
			'users' => $this->userModel->getCountUser()
		];

		// dd($count['users']);

		$data = [
			'title' => 'Dashboard',
			'surat' => $this->suratModel->getSurat(),
			'surat_keluar' => $this->suratKeluarModel->getSuratKeluar(),
			'users' => $this->userModel->getUser(),
			'user' => $this->userModel->getCountUser(),
			'role' => $this->groupsModel->getCountRole(),
			'suratMasuk' => $this->suratModel->getCountSuratMasuk(),
			'suratKeluar' => $this->suratKeluarModel->getCountSuratKeluar()
		];

		return view('pages/home', $data);
	}
}
