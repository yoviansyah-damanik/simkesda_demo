<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPMYearly extends Model
{
    use HasFactory;

    public $table = 'spm_yearlies';
    protected $guarded = ['id'];
    protected $hidden = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id', 'id');
    }
}
