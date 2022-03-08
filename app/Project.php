<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    
    protected $fillable = ['name', 'description', 'users' , 'URL', 'type'];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function losses()
    {
        return $this->hasMany(Loss::class, 'project_id', 'id');
    }

    public function hazards()
    {
        return $this->hasMany(Hazard::class, 'project_id', 'id');
    }
}
