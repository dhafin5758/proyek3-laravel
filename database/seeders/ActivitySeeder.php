<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi menggunakan repository Git dan GitHub.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing pada aplikasi web.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Praktikum Laravel Lanjut',
                'description' => 'Mempelajari service class, repository pattern, dan clean code.',
                'activity_date' => '2026-09-28',
                'category' => 'Praktikum',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Presentasi Proyek Modul 2',
                'description' => 'Presentasi hasil pengerjaan Proyek 3 Modul 2 (JavaScript).',
                'activity_date' => '2026-09-20',
                'category' => 'Presentasi',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Review Kode Peer',
                'description' => 'Sesi peer code review antar anggota kelas D3-2A.',
                'activity_date' => '2026-10-19',
                'category' => 'Review',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Setup SonarQube',
                'description' => 'Konfigurasi dan penggunaan SonarQube untuk analisis kualitas kode.',
                'activity_date' => '2026-09-22',
                'category' => 'Workshop',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
