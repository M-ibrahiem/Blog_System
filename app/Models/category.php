<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;


    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['image'];

}
