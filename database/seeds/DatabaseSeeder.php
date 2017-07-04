<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->get()->count() == 0){
            DB::table('users')->insert([
                [
                    'name' 			=> 'superadmin',
                    'email' 		=> 'ghi.fai@gmail.com',
                    'password' 		=> bcrypt('superadmin'),
                    'api_token'		=> hash('whirlpool','ghi.fai@gmail.com'),
                    'created_at' 	=> date('Y-m-d H:i:s'),
                    'updated_at' 	=> date('Y-m-d H:i:s'),
                ],
                [
                    'name' 			=> 'userone',
                    'email' 		=> 'userone@dummymail.com',
                    'password' 		=> bcrypt('userone'),
                    'api_token'		=> hash('whirlpool','userone@dummymail.com'),
                    'created_at' 	=> date('Y-m-d H:i:s'),
                    'updated_at' 	=> date('Y-m-d H:i:s'),
                ],
                [
                    'name' 			=> 'usertwo',
                    'email' 		=> 'usertwo@dummymail.com',
                    'password' 		=> bcrypt('usertwo'),
                    'api_token'		=> hash('whirlpool','usertwo@dummymail.com'),
                    'created_at' 	=> date('Y-m-d H:i:s'),
                    'updated_at' 	=> date('Y-m-d H:i:s'),
                ]
            ]);
        }
    	
        // used to call extended database seed
        // $this->call(UsersTableSeeder::class);
        $this->call(FakerDataSeeder::class);
    }
}
