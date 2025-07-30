<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_name'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'education_level_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'education_level_id');
    }
}
