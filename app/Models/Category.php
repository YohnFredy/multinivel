<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description','parent_id'];

      // Subcategorías
      public function children()
      {
          return $this->hasMany(Category::class, 'parent_id');
      }
  
      // Categoría padre
      public function parent()
      {
          return $this->belongsTo(Category::class, 'parent_id');
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
