<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat_masuk';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['nomor_agenda', 'tanggal_penerimaan', 'tk_keamanan', 'tanggal_penyelesaian', 'tanggal', 'nomor_surat', 'dari', 'perihal', 'lampiran', 'file_masuk', 'created_at', 'updated_at', 'disposisi', 'status'];

    public function getSurat($id = false)
    {
        if ($id == false) {
            return $this->orderBy('disposisi ASC, tanggal DESC')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getSuratKasubag($role = '')
    {
        if ($role != '') {
            $this->like('nomor_agenda', '3523' . $role . '%');
        }
        return $this->orderBy('status ASC, disposisi DESC, tanggal DESC')->findAll();
    }

    public function getSuratTim($idTim)
    {
        $query = "SELECT surat_masuk.*, disposisi.id as id_disposisi FROM `surat_masuk` JOIN disposisi on surat_masuk.id = disposisi.id_surat JOIN role_disposisi on disposisi.id = role_disposisi.id_disposisi WHERE role_disposisi.id_role = $idTim AND surat_masuk.status = 1";
        return $this->db->query($query)->getResultArray();
    }

    public function getUserFromSuratDisposisi($idSurat)
    {
        $this->where('surat_masuk.id', $idSurat);
        $this->join('disposisi', 'surat_masuk.id=disposisi.id_surat');
        $this->join('role_disposisi', 'disposisi.id=role_disposisi.id_disposisi');
        $this->join('users', 'role_disposisi.id_role=users.auth_groups_id');
        $this->select('users.email');
        return $this->findAll();
    }

    public function getCountSuratTerdisposisi()
    {
        $this->where('disposisi', 1);
        return $this->countAllResults();
    }

    public function getCountMenungguDisposisi()
    {
        $this->where('disposisi', 0);
        return $this->countAllResults();
    }

    public function getCountMenungguDikirim()
    {
        $this->where('disposisi', 1);
        $this->where('status', 0);
        return $this->countAllResults();
    }

    public function getCountSuratMasuk()
    {
        return $this->countAllResults();
        // return $this->where('id', 3)->countAllResults();
    }
}
