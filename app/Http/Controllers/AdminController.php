<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Flight;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/home');
    }

    /**
     * Return all users
     */
    public function users()
    {
        return response()->json(User::all());
    }

    /**
     * Adds a new user through api
     */
    public function adduser(Request $request)
    {
        $user = new User($request->input());
        $user->save();

        return response()->json(['created' => true], 201);
    }

    /**
     * Removes user through api
     */
    public function deluser(Request $request)
    {
        $deleted = User::where('id', $request->input('id', -1))->delete();

        return response()->json(['deleted' => $deleted>0], 200);
    }
}
