<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class FakerDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::Create('App\Supplier');
        for($l=1;$l<=10;$l++){
            DB::table('suppliers')->insert([
                'supplier_name'     => $faker->name,
                'supplier_address'  => $faker->address,
                'supplier_phone'    => $faker->regexify('[0]{1}[8]{1}[9]{2}\d{7}'),
                'updated_at'        => Carbon::now(),
                'created_at'        => Carbon::now(),
            ]);
        }
    }
}
