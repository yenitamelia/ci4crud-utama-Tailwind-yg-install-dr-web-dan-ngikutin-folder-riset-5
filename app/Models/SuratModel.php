<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['nomor_agenda', 'tanggal_penerimaan', 'tk_keamanan', 'tanggal_penyelesaian', 'tanggal', 'nomor_surat', 'dari', 'perihal', 'lampiran', 'created_at', 'updated_at', 'disposisi'];

    public function getSurat($id = false)
    {
        if ($id == false) {
            return $this->orderBy('disposisi ASC, tanggal DESC')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getSuratTim($idTim)
    {
        $query = "SELECT surat.*,disposisi.* FROM `surat` JOIN disposisi on surat.id = disposisi.id_surat WHERE disposisi.id_role = $idTim AND disposisi.status = 1";
        return $this->db->query($query)->getResult();
    }
}
