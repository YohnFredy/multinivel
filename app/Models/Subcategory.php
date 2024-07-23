<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = static::generateSlug($model->name);
        });
    }

    public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function latestImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany();
    }

    public function oldestImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->oldestOfMany();
    }
}
