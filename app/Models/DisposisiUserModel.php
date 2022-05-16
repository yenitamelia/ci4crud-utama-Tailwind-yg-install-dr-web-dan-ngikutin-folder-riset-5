<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiUserModel extends Model
{
    protected $table = 'disposisi_user';
    protected $userTimestamps = false;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['id_disposisi', 'id_user'];

    public function getByDisposisiIdsDistinct($ids)
    {
        $builder = $this->db->table('disposisi_user');
        $builder->select('DISTINCT(id_disposisi)');
        $builder->whereIn('id_disposisi', $ids);
        return $builder->get()->getResultArray();
    }

    public function getByUserId($userId)
    {
        $builder = $this->db->table('disposisi_user');
        $builder->join('disposisi', 'disposisi_user.id_disposisi=disposisi.id');
        $builder->join('surat_masuk', 'disposisi.id_surat=surat_masuk.id');
        $builder->select('surat_masuk.*');
        $builder->where('id_user', $userId);
        return $builder->get()->getResultArray();
    }
}
