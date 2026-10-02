<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $seminar = Category::create(['name' => 'Seminar', 'slug' => 'seminar']);
        $workshop = Category::create(['name' => 'Workshop', 'slug' => 'workshop']);
        $lomba = Category::create(['name' => 'Lomba', 'slug' => 'lomba']);

        $activities = [
            ['category_id' => $workshop->id, 'code' => 'WS-001', 'title' => 'Workshop Git Dasar', 'location' => 'Lab Komputer A', 'capacity' => 30, 'start_at' => '2026-10-10 08:00:00', 'end_at' => '2026-10-10 12:00:00', 'status' => 'published'],
            ['category_id' => $seminar->id,  'code' => 'SM-001', 'title' => 'Seminar Web Quality', 'location' => 'Aula Utama', 'capacity' => 100, 'start_at' => '2026-10-15 09:00:00', 'end_at' => '2026-10-15 11:00:00', 'status' => 'published'],
            ['category_id' => $workshop->id, 'code' => 'WS-002', 'title' => 'Workshop Laravel Lanjut', 'location' => 'Lab Komputer B', 'capacity' => 25, 'start_at' => '2026-10-20 13:00:00', 'end_at' => '2026-10-20 17:00:00', 'status' => 'draft'],
            ['category_id' => $seminar->id,  'code' => 'SM-002', 'title' => 'Seminar Keamanan Data', 'location' => 'Ruang Seminar', 'capacity' => 50, 'start_at' => '2026-09-20 09:00:00', 'end_at' => '2026-09-20 11:00:00', 'status' => 'completed'],
            ['category_id' => $lomba->id,    'code' => 'LB-001', 'title' => 'Lomba Web Design', 'location' => 'Lab Desain', 'capacity' => 40, 'start_at' => '2026-11-01 08:00:00', 'end_at' => '2026-11-01 16:00:00', 'status' => 'draft'],
            ['category_id' => $lomba->id,    'code' => 'LB-002', 'title' => 'Hackathon Proyek 3', 'location' => 'Gedung IT', 'capacity' => 60, 'start_at' => '2026-11-10 08:00:00', 'end_at' => '2026-11-11 17:00:00', 'status' => 'draft'],
        ];

        foreach ($activities as $data) {
            Activity::create(array_merge($data, ['description' => 'Deskripsi kegiatan.', 'activity_date' => substr($data['start_at'], 0, 10)]));
        }
    }
}
