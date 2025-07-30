<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name' => 'PURE for IT Solutions',
                'country' => 'الكويت',
                'business_type' => 'تطوير البرمجيات',
                'employee_count' => 150
            ],
            [
                'name' => 'Tech Solutions Co.',
                'country' => 'السعودية',
                'business_type' => 'تطوير البرمجيات',
                'employee_count' => 200
            ],
            [
                'name' => 'Digital Marketing Pro',
                'country' => 'الإمارات',
                'business_type' => 'التسويق الرقمي',
                'employee_count' => 80
            ],
            [
                'name' => 'Construction Experts',
                'country' => 'قطر',
                'business_type' => 'الهندسة المدنية',
                'employee_count' => 300
            ],
            [
                'name' => 'Healthcare Plus',
                'country' => 'البحرين',
                'business_type' => 'الطب والصحة',
                'employee_count' => 120
            ],
            [
                'name' => 'Education First',
                'country' => 'عمان',
                'business_type' => 'التعليم',
                'employee_count' => 90
            ],
            [
                'name' => 'Financial Services Ltd',
                'country' => 'الكويت',
                'business_type' => 'المحاسبة والمالية',
                'employee_count' => 75
            ],
            [
                'name' => 'HR Solutions',
                'country' => 'السعودية',
                'business_type' => 'الموارد البشرية',
                'employee_count' => 60
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
