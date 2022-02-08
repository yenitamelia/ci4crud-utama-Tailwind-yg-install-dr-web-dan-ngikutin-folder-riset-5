<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupsModel extends Model
{
    protected $table = 'auth_groups';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['name', 'description'];

    public function getGroups($id = false)
    {
        return $this->findAll();
    }

    public function getRole($id)
    {
        $query = "SELECT * FROM auth_groups_users WHERE user_id = $id";
        return $this->db->query($query)->getRow()->group_id;
    }
}
