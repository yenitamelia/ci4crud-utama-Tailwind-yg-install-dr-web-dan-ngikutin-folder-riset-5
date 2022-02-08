<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table = 'disposisi';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['isi_disposisi', 'id_surat', 'id_role', 'gambar', 'status'];

    // public function getSurat($id = false)
    // {
    //     if ($id == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['id' => $id])->first();
    // }
}
