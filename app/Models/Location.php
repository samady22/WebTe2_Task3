<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'country_name',
        'country_code',
        'flag',
        'city',
        'lat',
        'lon'
    ];
}
