<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!empty(DB::table('users')->where('email', 'admin@example.com')->get())){
            DB::table('users')->where('email', 'admin@example.com')->delete();
        }

        //create admin
        factory(User::class)->create([
            'email' => 'admin@example.com',
            'password' => '$2y$12$ixSKICOPlCNrRMhEWdrM8O3Ct3Aa.C1bc7C5Thz95A6c9Q/WZ/pHu', //Qwertyhn
            'role' => 'admin'
        ]);
    }
}
