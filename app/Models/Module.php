<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relation avec les cours
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function grades()
{
    return $this->hasOne(Grade::class,'module_id');
}
public function modules()
{
    return $this->belongsToMany(Module::class, 'module_prof', 'prof_id', 'module_id');
}

}
