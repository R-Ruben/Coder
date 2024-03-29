<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function receiving_user() {
        return $this->belongsTo('App\User');
    }
}
