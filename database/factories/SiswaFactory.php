<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Siswa;
use Faker\Generator as Faker;

$factory->define(Siswa::class, function (Faker $faker) {
    $jurusan = $faker->randomElement(['AK', 'RPL', 'TKJ']);

    switch ($jurusan) {
        case 'AK':
            $kelas = $faker->numberBetween(1, 6);
            break;
        case 'RPL':
            $kelas = $faker->numberBetween(1, 2);
            break;
        case 'TKJ':
            $kelas = $faker->numberBetween(1, 3);
            break;
    }

    return [
        'nis' => $faker->unique()->numberBetween(100, 999),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'nama' => $faker->firstName,
        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        'jurusan' => $jurusan,
        'kelas' => $kelas,
        'tahun' => $faker->numberBetween(2020, 2021),
    ];
});
