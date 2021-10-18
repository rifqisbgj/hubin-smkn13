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
            'nama' => 'PT. Farma',
            'bidang' => 'Kimiawi',
            'kontak' => 'farma@google.co.id',
            'jurusan' => 'AK',
            'tahun' => 2021,
            'alamat' => 'Jl. AH. Nasution Bandung',
            'kuota' => 4,
            'catatan' => 'Laki-laki, Mempunyai SIM, Bisa mengendarai motor',
            'nama_pembimbing' => 'Junaedi',
            'nip_pembimbing' => 123,
        ]);

        DB::table('industri')->insert([
            'nama' => 'PT. Tidak Sukses',
            'bidang' => 'Listrik Elektrik',
            'kontak' => '089994923324',
            'jurusan' => 'RPL,TKJ',
            'tahun' => 2021,
            'alamat' => 'Jl. Soekarno Hatta',
            'kuota' => 2,
            'nis_pengaju' => 123,
            'status' => false,
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
