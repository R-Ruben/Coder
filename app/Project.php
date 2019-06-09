<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use Sortable;
    public $sortable = ['title', 'created_at', 'deadline', 'price', 'price_type'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function programming_languages() {
        return $this->belongsToMany('App\ProgrammingLanguage', 'project_programming_language');
    }

    public function applications() {
        return $this->hasMany('App\Application');
    }
}
