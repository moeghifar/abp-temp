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
    	DB::table('users')->insert(
            [
                'name' 			=> 'super@dmin',
                'email' 		=> 'ghi.fai@gmail.com',
                'password' 		=> bcrypt('super@dmin'),
                'api_token'		=> hash('whirlpool','ghi.fai@gmail.com'),
                'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' 	=> Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' 			=> 'userone',
                'email' 		=> 'userone@dummymail.com',
                'password' 		=> bcrypt('userone'),
                'api_token'		=> hash('whirlpool','userone@dummymail.com'),
                'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' 	=> Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' 			=> 'usertwo',
                'email' 		=> 'usertwo@dummymail.com',
                'password' 		=> bcrypt('usertwo'),
                'api_token'		=> hash('whirlpool','usertwo@dummymail.com'),
                'created_at' 	=> Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' 	=> Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
        // used to call extended database seed
        // $this->call(UsersTableSeeder::class);
        $this->call(FakerDataSeeder::class);
    }
}
