<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industri')->insert([
            'nama' => 'PT. Fagma',
            'tahun' => 2021,
            'alamat' => 'Jl. AH. Nasution Bandung',
            'kuota' => 4,
            'pembimbing' => 'Junaedi',
            'nip_pembimbing' => '123',
        ]);

        DB::table('siswa')->insert([
            'nis' => 123,
            'password' => Hash::make('satu'),
            'nama' => 'Adit',
            'jenis_kelamin' => 'L',
            'jurusan' => 'RPL',
            'kelas' => 1,
            'tahun' => 2021,
            'id_industri' => 1,
        ]);

        DB::table('admin')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
