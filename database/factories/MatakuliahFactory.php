<?php

namespace Database\Factories;

use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Matakuliah::class;
    public function definition(): array
    {
        return [
            'id_matakuliah' => $this->faker->unique()->numerify('MK ###'),
            'nama_matakuliah' => $this->faker->word(),
            'dosen_pengajar' => $this->faker->name(),
            'jenis_matakuliah' => $this->faker->word(),
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'jam_mulai' => $this->faker->time(),
            'jam_selesai' => $this->faker->time(),
            'ruangan' => $this->faker->word(),
        ];
    }
}
