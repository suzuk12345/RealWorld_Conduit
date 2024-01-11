<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'tag_name'
    ];
    protected $hidden = [
        'id',
        'article_id',
    ];

    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
