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

    public function getUserAnggota()
    {
        $builder = $this->db->table('users');
        $builder->where('auth_groups_id', 8);
        return $builder->get()->getResultArray();
    }

    public function getUsersByRoleId($roleId)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('auth_groups_id', $roleId);
        return $builder->get()->getResultArray();
    }

    public function getUserByEmail($email)
    {
        $this->join('auth_groups', 'users.auth_groups_id=auth_groups.id');
        $this->select('users.*, auth_groups.description as role_name');
        $this->where('email', $email);
        return $this->first();
    }

    public function getUsers()
    {
        $query = "SELECT auth_groups.*, users.* FROM auth_groups JOIN users on auth_groups.id = users.auth_groups_id";
        return $this->db->query($query)->getResultArray();
    }

    public function getUserWhereIdIn($ids)
    {
        $this->whereIn('id', $ids);
        return $this->findAll();
    }

    public function getCountUser()
    {
        return $this->countAllResults();
        // return $this->where('id', 3)->countAllResults();
    }
}
