<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory, Sluggable;

    protected $hidden = 'id';

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getIsPublishedAttribute()
    {
        if (!$this->published_at)
            return 0;

        return 1;
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '!=', null);
    }
}
