<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;

class FlightController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Adds a new flight
     */
    public function addFlight(Request $request){
        $flight = new Flight;
        
        $flight->departure_time = $request->input('departure_time');
        $flight->arrival_time = $request->input('arrival_time');
        $flight->seats = $request->input('seats');
        $flight->price = $request->input('price');

        $flight->save();
        return response()->json(['created' => true], 201);
    }    

     /**
      * Gets all flights
      */
    public function flights(){
        return response()->json(Flight::all());
    }
}
