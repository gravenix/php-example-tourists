<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Delete given flight
     */
    public function delFlight(Request $request){
        $deleted = Flight::where('id', $request->input('id', -1))->delete();

        return response()->json(['deleted' => $deleted>0], 200);
    }

    /**
     * Updates info about flights
     */
    public function updateFlight(Request $request, $id){
        try{
            $flight = Flight::findOrFail($id)->first();
            foreach($request->input() as $key => $val){
                if(!in_array($key, array("departure_time", "arrival_time", "seats", "price"))) continue;
                $flight->$key = $val;
            }
            $flight->save();
        } catch(ModelNotFoundException $e){
            return response()->json(['updated' => false], 200);
        }
        return response()->json(['updated' => true], 200);
    }

     /**
      * Gets all flights
      */
    public function flights(){
        return response()->json(Flight::orderBy('departure_time')->get());
    }
}
