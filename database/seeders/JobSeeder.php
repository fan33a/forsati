<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'مطور ويب وجوال',
                'work_place' => 'الكويت',
                'salary_range' => '2.5K - 5K د.ك',
                'description' => 'نبحث عن مطور ويب وجوال ذو خبرة في تطوير التطبيقات الحديثة باستخدام أحدث التقنيات.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 3,
                'work_field_id' => 1,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 1,
                'business_man_id' => 1
            ],
            [
                'title' => 'مهندس برمجيات',
                'work_place' => 'الرياض',
                'salary_range' => '15K - 20K ر.س',
                'description' => 'مهندس برمجيات ذو خبرة في تطوير الأنظمة المعقدة وإدارة المشاريع التقنية.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 5,
                'work_field_id' => 1,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 2,
                'business_man_id' => 1
            ],
            [
                'title' => 'مصمم واجهات مستخدم',
                'work_place' => 'دبي',
                'salary_range' => '8K - 12K د.إ',
                'description' => 'مصمم واجهات مستخدم ذو خبرة في تصميم واجهات جميلة وسهلة الاستخدام.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 2,
                'work_field_id' => 2,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 3,
                'business_man_id' => 1
            ],
            [
                'title' => 'مهندس مدني',
                'work_place' => 'الدوحة',
                'salary_range' => '10K - 15K ر.ق',
                'description' => 'مهندس مدني ذو خبرة في تصميم وإدارة المشاريع الإنشائية الكبيرة.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 4,
                'work_field_id' => 7,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 4,
                'business_man_id' => 1
            ],
            [
                'title' => 'طبيب أسنان',
                'work_place' => 'المنامة',
                'salary_range' => '3K - 5K د.ب',
                'description' => 'طبيب أسنان ذو خبرة في طب الأسنان التجميلي والعلاجي.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 3,
                'work_field_id' => 10,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 5,
                'business_man_id' => 1
            ],
            [
                'title' => 'معلم رياضيات',
                'work_place' => 'مسقط',
                'salary_range' => '800 - 1200 ر.ع',
                'description' => 'معلم رياضيات ذو خبرة في تدريس الرياضيات للمراحل الثانوية.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 2,
                'work_field_id' => 11,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 6,
                'business_man_id' => 1
            ],
            [
                'title' => 'محاسب مالي',
                'work_place' => 'الكويت',
                'salary_range' => '1.5K - 2.5K د.ك',
                'description' => 'محاسب مالي ذو خبرة في المحاسبة المالية والضرائب.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 3,
                'work_field_id' => 5,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 7,
                'business_man_id' => 1
            ],
            [
                'title' => 'مدير موارد بشرية',
                'work_place' => 'الرياض',
                'salary_range' => '12K - 18K ر.س',
                'description' => 'مدير موارد بشرية ذو خبرة في إدارة الموظفين والتوظيف.',
                'from_date' => '2024-01-01',
                'to_date' => '2024-12-31',
                'gender_preference' => 'all',
                'education_level_id' => 3,
                'work_experience' => 5,
                'work_field_id' => 6,
                'country_of_graduation_id' => 5,
                'country_of_residence_id' => 5,
                'company_id' => 8,
                'business_man_id' => 1
            ]
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
