<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    //
    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function posts() {
        return $this->belongsToMany('App\Post');
    }

    public function projects() {
        return $this->belongsToMany('App\Project', 'project_programming_language');
    }

    
}
