<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $userTimestamps = true;
    // Karena ditabel surat ada beberapa atribut yg gadipakai misalnya id, updated_at, delete_at
    // Maka harus diberitahu mana fields yg boleh diisi
    protected $allowedFields = ['email', 'fullname', 'user_image', 'auth_groups_id', 'active'];
    // protected $allowedFields = ['nomor_agenda', 'tanggal_penerimaan', 'tk_keamanan', 'tanggal_penyelesaian', 'tanggal', 'nomor_surat', 'dari', 'perihal', 'lampiran', 'created_at', 'updated_at', 'disposisi'];


}
