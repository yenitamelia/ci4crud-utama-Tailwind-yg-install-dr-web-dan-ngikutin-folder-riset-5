<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['id', 'email', 'fullname', 'role_id', 'status_active', 'created_at', 'updated_at'];

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
        $builder->where('role_id', 8);
        return $builder->get()->getResultArray();
    }

    public function getUsersByRoleId($roleId)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('role_id', $roleId);
        return $builder->get()->getResultArray();
    }

    public function getUsersByRoleIdNew($roleId)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('role_id', $roleId);
        return $this->findAll();
    }

    public function getUserByEmail($email)
    {
        $this->join('role', 'users.role_id=role.id');
        $this->select('users.*, role.description as role_name');
        $this->select('users.*, role.id as role_id');
        $this->where('email', $email);
        return $this->first();
    }

    public function getUsers()
    {
        $query = "SELECT role.*, users.* FROM role JOIN users on role.id = users.role_id";
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
