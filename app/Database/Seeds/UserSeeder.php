<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Menggunakan Query Builder untuk insert data ke dalam tabel users
        $this->db->table('users')->insertBatch($data);
    }
}
