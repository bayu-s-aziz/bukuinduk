<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uri' => Str::random(50),
            'nama' => $this->faker->name(),
            'tempat_lahir' => $this->faker->randomElement(['Ciamis', 'Tasikmalaya', 'Garut', 'Banjar']),
            'tanggal_lahir' => '1968-11-05',
            'agama' => $this->faker->randomElement(['Islam', 'Protestan', 'Katholik', 'Buddha', 'Hindu']),
            'kewarganegaraan' => 'Indonesia',
            'pekerjaan' => $this->faker->randomElement(['Dokter', 'Pedagang', 'Pegawai Swasta', 'Pegawai Negeri', 'Wiraswasta']),
            'alamat' => $this->faker->address(),
            'nomor_hp' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['Masih Hidup', 'Telah Meninggal']),
            'created_at' => now()
        ];
    }
}
