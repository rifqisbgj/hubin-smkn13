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
        DB::table('siswa')->insert([
            'nis' => 1,
            'password' => Hash::make('satu'),
            'nama' => 'Adit',
            'kelas' => 'RPL 1',
        ]);

        DB::table('admin')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
