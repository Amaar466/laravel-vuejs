<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booktable extends Model
{
    use HasFactory;
    protected $table = 'booktables';

    // Specify the fillable fields
    protected $fillable = [
        'name',
        'phone',
        'email',
        'reservation_date',
        'reservation_time',
        'people'
    ];
}
