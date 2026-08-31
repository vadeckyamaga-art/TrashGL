<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Str;
use Override;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'pseudonym',
        'email',
        'password',
        'provider',
        'provider_id',
        'language',
        'theme',
        'email_verification_code',
        'email_verification_expires_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    #[Override]
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $lastId = static::orderByDesc('id')->value('id');
            $number = $lastId ? (int) substr($lastId, 5) +1 : 1;
            $user->id = 'USER_'.str_pad($number, 8, '0', STR_PAD_LEFT);

            if (empty($user->pseudonym)) {
                $user->pseudonym = static::generatePseudonym();
            }
        });
    }

    protected static function generatePseudonym(): string
    {
        do {
            $pseudonym = 'Anonym'.random_int(100000, 999999);
        } while (static::where('pseudonym', $pseudonym)->exists());
        return $pseudonym;
    }

    //---------------------------- Relations ---------------------------------------

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reposts()
    {
        return $this->hasMany(Repost::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
                ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
                ->withTimestamps();
    }

    //------------------------------------- Helpers ---------------------------------
    public function isFollowing (User $user):bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }


}
