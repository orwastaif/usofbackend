<?php 

namespace App\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Comment class instance will refer to comment table in database
class Comments extends Model
{
  use HasFactory;
    protected $fillable = [
        'author_id',
        'on_post',
        'from_user',
        'body',
    ];
}