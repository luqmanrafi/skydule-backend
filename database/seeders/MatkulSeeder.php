<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    private $jamTersedia = [
        ['08:00', '10:00'],
        ['10:00', '12:00'],
        ['13:00', '15:00'],
        ['15:00', '17:00']
    ];

    public function run(): void
    {
        // User::factory(10)->create();

        $matkulList = [
            'Pemrograman Lanjut',
            'Struktur Data',
            'Basis Data',
            'Jaringan Komputer',
            'Sistem Operasi',
            'Algoritma dan Pemrograman',
            'Pemrograman Web',
            'Kecerdasan Buatan'
        ];

        foreach ($matkulList as $index => $nama) {
            $hari = $this->hari[array_rand($this->hari)];
            $slot = $this->cariSlotYangTersedia($hari);

            if ($slot) {
                Matakuliah::create([
                    'id_matakuliah' => 'MK' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                    'nama_matakuliah' => $nama,
                    'dosen_pengajar' => fake()->name(),
                    'jenis_matakuliah' => fake()->randomElement(['Teori', 'Praktikum']),
                    'hari' => $hari,
                    'jam_mulai' => $slot[0],
                    'jam_selesai' => $slot[1],
                    'ruangan' => 'R' . rand(101, 110),
                ]);

                $this->command->info("✅ $nama ditambahkan di hari $hari ($slot[0] - $slot[1])");
            } else {
                $this->command->warn("❌ Tidak ada slot tersedia untuk $nama di hari $hari");
            }
        }
    }
    private function cariSlotYangTersedia(string $hari): ?array
    {
        foreach ($this->jamTersedia as $slot) {
            $bentrok = Matakuliah::where('hari', $hari)
                ->where(function ($query) use ($slot) {
                    $query->where('jam_mulai', '<', $slot[1])
                        ->where('jam_selesai', '>', $slot[0]);
                })
                ->exists();

            if (!$bentrok) {
                return $slot;
            }
        }
        return null;
    }
}
