<?php

namespace App\Http\Controllers;

use App\Flight;
use App\User;
use App\FlightUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FlightUserController extends Controller
{
    /**
     * Check if logged in
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Assign user to a Flight.
     */
    public function addRelation(Request $req, $flight_id, $user_id=null){
        $failed = ['status' => 'failed'];
        if($user_id==null){//you must be logged in, middleware in __construct
            $user_id = Auth::user()->id;
        } else{
            if(Auth::user()->role!='admin') //only admin can add every users to every flight 
                return response()->json($failed, 403);
        }
        try{
            $flight = Flight::findOrFail($flight_id);
            User::findOrFail($user_id); // this will throw exception if there is no user with given id
            if($flight->users()->find($user_id)!=null //user alredy assigned to a flight
                || $flight->users()->count()>=$flight->seats){ //is there a place for user?
                return response()->json($failed, 403);
            }
        } catch(ModelNotFoundException $e){
            return response()->json($failed, 404);
        }
        $flight->users()->attach($user_id);
        return response()->json(['status' => 'success'], 200);
    }

    
    /**
     * Delete user from a Flight.
     */
    public function delRelation(Request $req, $flight_id, $user_id=null){
        if($user_id==null){//you must be logged in, middleware in __construct
            $user_id = Auth::user()->id;
        } else{
            if(Auth::user()->role!='admin') //only admin can add every users to every flight 
                return response()->json(null, 403);
        }
        try{
            $flight = Flight::findOrFail($flight_id);
            if($flight->users()->find($user_id)!=null){ //user alredy assigned to a flight?
                $flight->users()->detach($user_id);
                return response()->json(null, 200);
            }
        } catch(ModelNotFoundException $e){
            return response()->json(null, 404);
        }
        return response()->json(null, 404);
    }
}
