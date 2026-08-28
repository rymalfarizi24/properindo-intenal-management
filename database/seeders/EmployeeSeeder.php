<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Andi Saputra',
                'department' => 'Finance',
                'position' => 'Staff Finance',
                'email' => 'andi@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'department' => 'IT',
                'position' => 'Programmer Junior',
                'email' => 'budi@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Citra Lestari',
                'department' => 'HR',
                'position' => 'HR Administrator',
                'email' => 'citra@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Dewi Anggraini',
                'department' => 'Environment',
                'position' => 'Environmental Staff',
                'email' => 'dewi@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Eko Pratama',
                'department' => 'Operation',
                'position' => 'Operational Staff',
                'email' => 'eko@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Hendra Wijaya',
                'department' => 'IT',
                'position' => 'Database Administrator',
                'email' => 'hendra@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Lukman Hakim',
                'department' => 'IT',
                'position' => 'System Analyst',
                'email' => 'lukman@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Maya Putri',
                'department' => 'HR',
                'position' => 'HR Supervisor',
                'email' => 'maya@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Taufik Hidayat',
                'department' => 'Environment',
                'position' => 'Environmental Analyst',
                'email' => 'taufik@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Rizky Maulana',
                'department' => 'IT',
                'position' => 'Web Developer',
                'email' => 'rizky@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Sari Wulandari',
                'department' => 'Finance',
                'position' => 'Finance Supervisor',
                'email' => 'sari@properindoenviro.co.id',
                'status' => true,
            ],
            [
                'name' => 'Karin Amelia',
                'department' => 'Operation',
                'position' => 'Operational Supervisor',
                'email' => 'karin@properindoenviro.co.id',
                'status' => true,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create([
                ...$employee,
                'img' => null,
                'role' => 'employee',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
