<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email','password', 'CIN', 'phone', 'adresse', 'image', 'role', 'group_id'
    ];
    public function gradesStudent()
{
    return $this->hasMany(Grade::class, 'student_id');
}
public function gradeProf()
{
    return $this->hasMany(Grade::class, 'prof_id');
}
public function absencesStudent()
{
    return $this->hasMany(Absence::class, 'student_id');
}
// Relation avec les absences en tant que professeur
public function marquerAbsencesProf()
{
    return $this->hasMany(Absence::class, 'prof_id');
}
public function courses()
{
    return $this->hasMany(Course::class, 'student_id');
}
public function modules()
{
    return $this->belongsToMany(Module::class, 'module_prof', 'prof_id', 'module_id');
}
public function group()
{
    return $this->belongsTo(Group::class);
}


    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
