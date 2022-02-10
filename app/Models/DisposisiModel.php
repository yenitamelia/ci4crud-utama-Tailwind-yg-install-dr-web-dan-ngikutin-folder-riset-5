<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table = 'disposisi';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['isi_disposisi', 'id_surat', 'id_role', 'gambar'];

    public function getDisposisi($id = false)
    {
        return $this->findAll();
    }

    public function getIdRole($id)
    {
        $builder = $this->db->table('disposisi');
        $builder->join('auth_groups', 'disposisi.id_role=auth_groups.id');
        $builder->select('disposisi.*,auth_groups.description');
        $builder->where('disposisi.id_surat', $id);
        return $builder->get()->getResultArray();
    }
    // public function getSurat($id = false)
    // {
    //     if ($id == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['id' => $id])->first();
    // }
}
