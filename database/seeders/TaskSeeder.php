<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'employee_id' => 1, // Andi Saputra
                'title' => 'Pembuatan laporan PROPER Tahunan',
                'deadline' => '2026-09-30 23:59:59',
                'status' => 'progress',
                'priority' => 'high',
            ],
            [
                'employee_id' => 2, // Budi Santoso
                'title' => 'Update database perusahaan',
                'deadline' => '2026-09-25 23:59:59',
                'status' => 'pending',
                'priority' => 'medium',
            ],
            [
                'employee_id' => 4, // Dewi Anggraini
                'title' => 'Review dokumen lingkungan',
                'deadline' => '2026-09-28 23:59:59',
                'status' => 'completed',
                'priority' => 'medium',
            ],
            [
                'employee_id' => 3, // Citra Lestari
                'title' => 'Pembuatan invoice proyek',
                'deadline' => '2026-09-27 23:59:59',
                'status' => 'progress',
                'priority' => 'high',
            ],
            [
                'employee_id' => 6, // Hendra Wijaya
                'title' => 'Backup database server',
                'deadline' => '2026-09-26 23:59:59',
                'status' => 'completed',
                'priority' => 'high',
            ],
            [
                'employee_id' => 7, // Lukman Hakim
                'title' => 'Pembuatan dashboard monitoring',
                'deadline' => '2026-10-05 23:59:59',
                'status' => 'progress',
                'priority' => 'high',
            ],
            [
                'employee_id' => 11, // Sari Wulandari
                'title' => 'Rekap absensi karyawan',
                'deadline' => '2026-10-01 23:59:59',
                'status' => 'pending',
                'priority' => 'low',
            ],
            [
                'employee_id' => 8, // Maya Putri
                'title' => 'Audit dokumen internal',
                'deadline' => '2026-10-10 23:59:59',
                'status' => 'pending',
                'priority' => 'medium',
            ],
            [
                'employee_id' => 12, // Karin Amelia
                'title' => 'Pembuatan laporan keuangan',
                'deadline' => '2026-10-15 23:59:59',
                'status' => 'progress',
                'priority' => 'high',
            ],
            [
                'employee_id' => 10, // Rizky Maulana
                'title' => 'Perbaikan sistem aplikasi',
                'deadline' => '2026-10-12 23:59:59',
                'status' => 'progress',
                'priority' => 'high',
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
