<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','user_id','active'];

    public $estados = ['Inactivo','Activo'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->first();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}
