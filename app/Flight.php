<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flight';

    protected $fillable = ['departure_time', 'arrival_time', 'seats', 'price'];

    /**
     * Get the users on this flight
     */
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
