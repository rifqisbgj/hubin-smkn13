<?php

use App\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Menambahkan data siswa random
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        factory(Siswa::class, $count)->create();
    }
}
