<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public static function booted(){
        static::creating(function($tag){
            $tag->uuid = Str::uuid();
            $tag->slug = Str::slug($tag->name);
        });
    }

    public static function filter($search){
        return Tag::where('name', 'like', "%{$search}%")
        ->orWhere('slug', 'like', "%{$search}%");
    }
}
