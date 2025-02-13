<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relation avec les absences
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
    public function students()
    {
        return $this->hasMany(User::class)->where('role','student');
    }
}
