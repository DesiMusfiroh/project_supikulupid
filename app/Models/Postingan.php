<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\User;

class Postingan extends Model
{
    use HasFactory;

    protected $table = "postingan";
    protected $fillable = ['user_id','kategori_id','subKategori_id','judul','isi','gambar','status','published_at'];
    protected $primaryKey = 'id_postingan';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id','id_kategori');
    }

    public function sub_kategori()
    {
        return $this->belongsTo(SubKategori::class,'subKategori_id','id_subkategori');
    }
    public function log()
    {
        return $this->hasMany(Log::class,'postingan_id');
    }
}
