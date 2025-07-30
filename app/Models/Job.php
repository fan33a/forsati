<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'work_place',
        'salary_range',
        'description',
        'from_date',
        'to_date',
        'gender_preference',
        'education_level_id',
        'work_experience',
        'work_field_id',
        'country_of_graduation_id',
        'country_of_residence_id',
        'company_id',
        'business_man_id'
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function workField()
    {
        return $this->belongsTo(WorkField::class, 'work_field_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }
}
