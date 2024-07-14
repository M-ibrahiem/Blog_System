<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, SoftDeletes, InteractsWithMedia;

    public $translatedAttributes = ['title', 'content', 'small_description', 'tags'];
    protected $fillable = ['category_id', 'image', 'user_id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

