<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ["title", "content", "image"];


    public static function boot()
    {
        Parent::boot();

        self::creating(function ($post) {
            $post->user()->associate(auth()->user()->id);
            $post->category()->associate(request()->category);
        });
        self::updating(function ($post) {

            $post->category()->associate(request()->category);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTitleAttribute($attribute)
    {

        return Str::title($attribute);
    }
}
