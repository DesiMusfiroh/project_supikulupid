<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubKategori;
use App\Models\Postingan;

class Kategori extends Model
{
    use HasFactory;
    
    protected $primaryKey='id_kategori';

    public function subKategori()
    {
        return $this->hasMany(SubKategori::class,'kategori_id','id_kategori');
    }

    public function postingan()
    {
        return $this->hasMany(Postingan::class,'kategori_id','id_kategori');
    }
}
