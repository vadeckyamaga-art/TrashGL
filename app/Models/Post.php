<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Override;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'content',
        'background_type',
        'background_value',
    ];

    #[Override]
    protected static function boot()
    {
        return parent::boot();

        static::creating(function ($post){
            $post->uuid = (string) Str::uuid();
        });
    }

    //--------------------- Relations -----------------------

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function reposts()
    {
        return $this->hasMany(Repost::class);
    }

    public function report()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    //------------------- Helpers ------------------------------------------------

    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    #[Override]
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
