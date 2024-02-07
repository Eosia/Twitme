<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Boolean;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts() {
        return $this->hasMany(Post::class)->orderByDesc('id');
    }

    public function likes() {
        return $this->hasMany(Like::class)->orderByDesc('id');
    }

    public function logins() {
        return $this->hasMany(Login::class);
    }

    public function followers() {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps()->withPivot(['created_at'])->orderBy('pivot_created_at', 'desc');
    }

    public function followings() {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps()->withPivot(['created_at'])->orderBy('pivot_created_at', 'desc');
    }

    public function toggleFollow(int $user_id) {
        if($this->id !== $user_id ) {
            $this->followings()->toggle([$user_id]);
        }
    }

    public function isFollower(int $user_id) : bool {
        Return DB::table('follows')->where('follower_id', $this->id)->where('following_id', $user_id)->count();
    }

    public function isFollowing(int $user_id) : bool {
        Return DB::table('follows')->where('following_id', $this->id)->where('follower_id', $user_id)->count();
    }

}


















