<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarRevisiModel extends Model
{
    protected $table = 'surat_keluar_revisi';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['id_surat_keluar', 'pesan_revisi'];

    public function getSuratKeluarRevisi($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getIdRole($id)
    {
        $builder = $this->db->table('disposisi');
        $builder->join('role', 'disposisi.id_role=role.id');
        $builder->select('disposisi.*,role.description');
        $builder->where('disposisi.id_surat', $id);
        return $builder->get()->getResultArray();
    }

    public function getSuratByDisposisiId($id_disposisi)
    {
        $this->where('disposisi.id', $id_disposisi);
        $this->join('surat_masuk', 'surat_masuk.id=disposisi.id_surat');
        $this->select('*');
        return $this->first();
    }
    // public function getSurat($id = false)
    // {
    //     if ($id == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['id' => $id])->first();
    // }
}
