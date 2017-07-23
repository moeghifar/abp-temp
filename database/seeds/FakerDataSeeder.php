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
        // faker tp generate supplier data
        $fakerSupplier = Faker::Create('App\Supplier');
        for($l=1;$l<=10;$l++){
            DB::table('suppliers')->insert([
                'supplier_name'     => $fakerSupplier->name,
                'supplier_address'  => $fakerSupplier->address,
                'supplier_phone'    => $fakerSupplier->regexify('[0]{1}[8]{1}[9]{2}\d{7}'),
                'updated_at'        => Carbon::now(),
                'created_at'        => Carbon::now(),
            ]);
        }
        // faker to generate customer data
        $fakerCustomer = Faker::Create('App\Customer');
        for($l=1;$l<=10;$l++){
            DB::table('customers')->insert([
                'customer_name'     => $fakerCustomer->name,
                'customer_address'  => $fakerCustomer->address,
                'customer_phone'    => $fakerCustomer->regexify('[0]{1}[8]{1}[9]{2}\d{7}'),
                'updated_at'        => Carbon::now(),
                'created_at'        => Carbon::now(),
            ]);
        }
    }
}
