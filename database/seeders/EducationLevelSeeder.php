<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EducationLevel;

class EducationLevelSeeder extends Seeder
{
    public function run(): void
    {
        $educationLevels = [
            ['level_name' => 'الثانوية العامة'],
            ['level_name' => 'دبلوم'],
            ['level_name' => 'بكالوريوس'],
            ['level_name' => 'ماجستير'],
            ['level_name' => 'دكتوراه'],
            ['level_name' => 'دورات تدريبية'],
            ['level_name' => 'شهادات مهنية']
        ];

        foreach ($educationLevels as $level) {
            EducationLevel::create($level);
        }
    }
}
