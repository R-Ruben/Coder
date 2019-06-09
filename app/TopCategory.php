<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCategory extends Model
{
    protected $table = 'top_categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function post()
    {
    	return $this->HasMany('App\Post');
    }
}
