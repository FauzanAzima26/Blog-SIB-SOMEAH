<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class articleTag extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'article_tag';
    
    protected $dates = ['deleted_at'];
}
