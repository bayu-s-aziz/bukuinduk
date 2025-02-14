<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Biodata;
use App\Models\Dad;
use App\Models\Mom;
use App\Models\Guardian;
use App\Models\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama_lengkap' => 'Admin',
            'foto' => NULL,
            'status' => 'Admin',
            'email' => 'alislam.gncupu@gmail.com',
            'password' => Hash::make('alislam.123'),
            'jenis_kelamin' => 'L',
        ]);

        DB::table('students')->insert([
            'year_id' => 1,
            'group_id' => 1,
            'nama_panggilan' => 'Emod',
            'nama_lengkap' => 'Ahmad Madyan',
            'foto' => NULL,
            'nisn' => '1233123341',
            'nis' => '1233123',
            'jenis_kelamin' => 'L',
        ]);

        DB::table('groups')->insert([
            'nama' => 'A',
            'uri' => Str::random(50),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('groups')->insert([
            'nama' => 'B',
            'uri' => Str::random(50),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('years')->insert([
            'tahun_ajaran' => '2024/2025',
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Student::factory(1)
            ->has(Biodata::factory()->count(1), 'biodata')
            ->has(Dad::factory()->count(1), 'ayah')
            ->has(Mom::factory()->count(1), 'ibu')
            ->has(Guardian::factory()->count(1), 'wali')
            ->create();
    }
}
