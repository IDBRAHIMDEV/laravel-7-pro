<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public const LOCALES = [
        'en' => 'English',
        'ar' => 'Arabic',
        'fr' => 'French'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        return $this->hasMany(Post::class);
    }

    public function image() {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }


    public function scopeUsersActive(Builder $query) 
    {
        return $query->withCount('posts')->orderBy('posts_count', 'desc');
    }

    public function scopeUserActiveInLastMonth(Builder $query)
    {
        return $query->withCount(['posts' => function(Builder $query) {
            $query->whereBetween(static::CREATED_AT, [now()->subMonths(10), now()]);
        }])
        ->having('posts_count', '>', 3)
        ->orderBy('posts_count', 'desc');
    }
    

}
