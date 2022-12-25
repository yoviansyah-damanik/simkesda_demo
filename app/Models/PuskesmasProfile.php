<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PuskesmasProfile extends Model
{
    use HasFactory;

    /**
     * Table name.
     *
     * @var string
     */
    protected $hidden = 'id';

    protected $guarded = ['id'];

    // public function 

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'id_provinsi');
    }

    public function regency()
    {
        return $this->hasOne(Regency::class, 'id', 'id_kabupaten');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'id_kecamatan');
    }

    public function village()
    {
        return $this->hasOne(Village::class, 'id', 'id_desa');
    }
}
