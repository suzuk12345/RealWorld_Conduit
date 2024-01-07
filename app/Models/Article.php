<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'body',
        'user_id'
    ];

    public function author()
    {
        return $this->hasMany(User::class);
    }
}