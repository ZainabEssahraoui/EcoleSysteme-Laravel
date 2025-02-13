<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'module_id',
        'student_id',
        'file_path',
    ];

    // Relation avec le module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Relation avec l'étudiant
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->where('role','student');
    }
}
