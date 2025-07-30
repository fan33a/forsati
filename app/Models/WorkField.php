<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'work_field_id');
    }
}
