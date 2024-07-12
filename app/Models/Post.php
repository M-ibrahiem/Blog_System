<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;


    public $translatedAttributes = ['title', 'content','small_description','tags'];
    protected $fillable = ['image'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }

}
