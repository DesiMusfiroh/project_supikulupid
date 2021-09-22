<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kategori;
use SubKategori;
use User;

class Postingan extends Model
{
    use HasFactory;

    protected $table = "postingan";


    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function kategori()
    {
        return $this->hasMany(Kategori::class,'kategori_id');
    }

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class,'kategori_id','id_kategori');
    }
}
