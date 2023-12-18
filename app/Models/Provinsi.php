<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'province_id');
    }

    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'province_id');
    }
}
