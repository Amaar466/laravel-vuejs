<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teammember extends Model
{
    use HasFactory;
    protected $table = 'teammembers';
    protected $fillable = ['name','image','position ', 'bio' ];
}
