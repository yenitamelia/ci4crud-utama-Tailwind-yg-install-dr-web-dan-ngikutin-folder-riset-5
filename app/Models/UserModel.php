<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['id', 'email', 'fullname', 'auth_groups_id', 'status_active', 'created_at', 'updated_at'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getUsers()
    {
        $query = "SELECT auth_groups.*, users.* FROM auth_groups JOIN users on auth_groups.id = users.auth_groups_id";
        return $this->db->query($query)->getResultArray();
    }

    public function getCountUser()
    {
        return $this->countAllResults();
        // return $this->where('id', 3)->countAllResults();
    }
}
