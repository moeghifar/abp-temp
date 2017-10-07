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
        // faker insert product
        $product = [
                [
                    'product_name'  => 'Iphone 7 - 128 GB',
                    'supplier_id'   => 1,
                    'price'         => '11000000',
                    'unit'          => 'pcs',
                    'updated_at'    => Carbon::now(),
                    'created_at'    => Carbon::now(),
                ],[
                    'product_name'  => 'Iphone 8 - 128 GB',
                    'supplier_id'   => 5,
                    'price'         => '14500000',
                    'unit'          => 'pcs',
                    'updated_at'    => Carbon::now(),
                    'created_at'    => Carbon::now(),
                ],[
                    'product_name'  => 'Iphone X - 128 GB',
                    'supplier_id'   => 2,
                    'price'         => '16450000',
                    'unit'          => 'pcs',
                    'updated_at'    => Carbon::now(),
                    'created_at'    => Carbon::now(),
                ],[
                    'product_name'  => 'Macbook Pro 13 inch - 2015' ,
                    'supplier_id'   => 3,
                    'price'         => '19850000',
                    'unit'          => 'pcs',
                    'updated_at'    => Carbon::now(),
                    'created_at'    => Carbon::now(),
                ],[
                    'product_name'  => 'Macbook Pro 13 inch - 2016' ,
                    'supplier_id'   => 4,
                    'price'         => '23250000',
                    'unit'          => 'pcs',
                    'updated_at'    => Carbon::now(),
                    'created_at'    => Carbon::now(),
                ]
            ];
        if(DB::table('products')->get()->count() == 0){
            DB::table('products')->insert($product);
        }
    }
}
