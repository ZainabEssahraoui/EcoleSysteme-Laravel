<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'student_id',
        'group_id',
        'prof_id',
        'scence',
        'date_absence',
        'si_present',
        'reason',
    ];
    

    /**
     * Relation avec le modèle User (étudiant).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->where('role','student');
    }
    public function professor()
    {
        return $this->belongsTo(User::class, 'prof_id')->where('role','prof');
    }
    /**
     * Relation avec le modèle Course (cours).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}