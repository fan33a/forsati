<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkField;

class WorkFieldSeeder extends Seeder
{
    public function run(): void
    {
        $workFields = [
            ['name' => 'تطوير البرمجيات'],
            ['name' => 'تصميم الويب'],
            ['name' => 'إدارة الأعمال'],
            ['name' => 'التسويق الرقمي'],
            ['name' => 'المحاسبة والمالية'],
            ['name' => 'الموارد البشرية'],
            ['name' => 'الهندسة المدنية'],
            ['name' => 'الهندسة الكهربائية'],
            ['name' => 'الهندسة الميكانيكية'],
            ['name' => 'الطب والصحة'],
            ['name' => 'التعليم'],
            ['name' => 'السياحة والفنادق'],
            ['name' => 'البيع والتجزئة'],
            ['name' => 'الخدمات اللوجستية'],
            ['name' => 'البحث والتطوير']
        ];

        foreach ($workFields as $workField) {
            WorkField::create($workField);
        }
    }
}
