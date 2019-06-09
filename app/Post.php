<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use Sortable;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public $sortable = ['title', 'created_at', 'top_category_id', 'rep'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function top_category() {
        return $this->belongsTo('App\TopCategory');
    }

    public function programming_languages() {
        return $this->belongsToMany('App\ProgrammingLanguage');
    }

    public function reputations() {
        return $this->hasMany('App\Reputation');
    }

}
