<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_picture', 'birthDate', 'country', 'website', 'rep', 'company_name', 'company_vat', 'company_logo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function workplaces() {
        return $this->belongsToMany('App\Workplace')->withTimestamps();
    }

    public function reputations() {
        return $this->hasMany('App\Reputation');
    }

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function applications() {
        return $this->hasMany('App\Application');
    }

    public function friends() {
        return $this->hasMany('App\Friend');
    }

    public function programming_languages() {
        return $this->belongsToMany('App\ProgrammingLanguage', 'user_programming_language');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }
}
