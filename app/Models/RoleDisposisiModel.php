<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleDisposisiModel extends Model
{
    protected $table = 'role_disposisi';
    protected $userTimestamps = false;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['id_disposisi', 'id_role'];

    public function getDisposisi($id = false)
    {
        return $this->findAll();
    }

    public function getIdRole($id)
    {
        $builder = $this->db->table('role_disposisi');
        $builder->join('role', 'disposisi.id_role=role.id');
        $builder->select('disposisi.*,role.description');
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
