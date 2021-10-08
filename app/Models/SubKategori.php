<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Postingan;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = "sub_kategoris";
    protected $primaryKey = "id_subkategori";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id');
    }

    public function postingan()
    {
        return $this->hasMany(Postingan::class,'subkategori_id', 'id_subkategori');
    }
}
