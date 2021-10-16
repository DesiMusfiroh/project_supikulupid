<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postingan;
use App\Models\User;

class Log extends Model
{
    use HasFactory;
    protected $table = "logs";
    protected $fillable = ['user_id','postingan_id','judul','status','pesan'];
   
    public function postingan()
    {
        return $this->belongsTo(Postingan::class,'postingan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
