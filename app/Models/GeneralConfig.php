<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralConfig extends Model
{
    use HasFactory;

    protected $hidden = 'id';

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
