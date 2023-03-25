<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected  $fillable =[
        'title',
        'slug',
        'description',
        'user_id',
        'image',
    ];

    public function user(){
        return $this->belongsTo(related:User::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');//take 2 arguments (class name, func name)
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }
}
