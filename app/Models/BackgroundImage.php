<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    protected $fillable = ['url', 'thumbnail_url', 'is_active'];
}
