<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'module_id', 'grade'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->where('role','student');
    }
    public function prof()
    {
        return $this->belongsTo(User::class, 'prof_id')->where('role','prof');
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
