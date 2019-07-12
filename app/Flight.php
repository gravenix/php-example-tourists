<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flight';

    protected $fillable = ['departure_time', 'arrival_time', 'seats', 'price'];
}
