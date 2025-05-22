<?php

namespace Tests\Unit;

use App\Models\Matakuliah;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class MatakuliahTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_matakuliah(): void
    {
        Matakuliah::factory()->count(2)->create();
        $response = $this->getJson('/api/matakuliah');
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Jadwal retrieved successfully',
            ]);
        
    }

    public function test_create_matakuliah(): void{
        $data = Matakuliah::factory()->make()->toArray();
        $response = $this->postJson('api/matakuliah', $data);

        $response->assertStatus(201)
                ->assertJsonFragment(['id_matakuliah' => $data['id_matakuliah']])
                ->assertJson([
                    'message' => 'Matakuliah berhasil dibuat',
                ]);
    }

    public function test_update_matakuliah(): void{
        $matakuliah = Matakuliah::factory()->create();
        $data = [
            'id_matakuliah' => $matakuliah->id_matakuliah,
            'nama_matakuliah' => 'Matematika',
            'dosen_pengajar' => 'Dr. John Doe',
            'jenis_matakuliah' => 'Teori',
            'hari' => 'Senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'ruangan' => 'A101',
        ];

        $response = $this->putJson('/api/matakuliah/'.$matakuliah->id, $data);
        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Jadwal berhasil diperbarui'
                ]);
    }

    public function test_delete_matakuliah(): void{
        $matakuliah = Matakuliah::factory()->create();
        $response = $this->deleteJson('/api/matakuliah/'.$matakuliah->id);
        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Jadwal berhasil dihapus'
                ]);
    }

}
