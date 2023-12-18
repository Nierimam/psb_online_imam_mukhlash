<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'kabupaten_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'province_id');
    }
}
