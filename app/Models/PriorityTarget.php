<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityTarget extends Model
{
    use HasFactory;

    protected $hidden = 'id';
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id', 'id');
    }
}
