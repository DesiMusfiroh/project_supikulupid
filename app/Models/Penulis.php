<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Penulis extends Model
{
    use HasFactory;

    protected $table = "penulis";
    protected $primaryKey = "id_penulis";
    protected $fillable = ['user_id','nama'];
   
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
