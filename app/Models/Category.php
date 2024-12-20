<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public static function booted(){
        static::creating(function($category){
            $category->uuid = Str::uuid();
            $category->slug = Str::slug($category->name);
        });
    }

    public static function filter($search){
        return Category::where('name', 'like', "%{$search}%")
        ->orWhere('slug', 'like', "%{$search}%");
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
