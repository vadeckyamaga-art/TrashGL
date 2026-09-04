<?php

namespace App\Models;

use App\Models\Comment;
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
        'background_image_id',
    ];

    #[Override]
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->uuid = $post->uuid ?? (string) Str::uuid();
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

    public function backgroundImage()
    {
        return $this->belongsTo(BackgroundImage::class);
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
