<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function user_question()
    {
        return $this->hasMany(Question::class);
    }

    public function booked()
    {
        return $this->hasMany(Booking::class, 'geek_id');
    }

    public function geek_question()
    {
        return $this->hasMany(Question::class, 'geek_id');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class, 'user_id');
    }

    public function userMeetings()
    {
        return $this->hasMany(Meeting::class, 'user_id');
    }

    public function geekMeetings()
    {
        return $this->hasMany(Meeting::class, 'geek_id');
    }

    public function geekReviews()
    {
        return $this->hasMany(Review::class, 'geek_id');
    }

    public function userReviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d F Y');
    }

    public function notifications()
    {
        return  $this->hasMany(Notification::class, 'user_id')->orderBy('created_at', 'desc');
    }
}
