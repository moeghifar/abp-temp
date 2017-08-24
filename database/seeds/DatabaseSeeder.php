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
        $coaData = [
                [
                    'number_of_accounts'    => '110',
                    'name_of_accounts'      => 'Cash',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '111',
                    'name_of_accounts'      => 'Account Receivable',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '115',
                    'name_of_accounts'      => 'Supplies',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '116',
                    'name_of_accounts'      => 'Office Supplies',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '120',
                    'name_of_accounts'      => 'Office Equipment',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '121',
                    'name_of_accounts'      => 'Accumulated Depreciation – Office Equipment',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '122',
                    'name_of_accounts'      => 'Office Vehicles',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '123',
                    'name_of_accounts'      => 'Accumulated Depreciation – Office Vehicles',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '100 Assets',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '210',
                    'name_of_accounts'      => 'Accounts Payable',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '200 Liabilities',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '310',
                    'name_of_accounts'      => 'Mr. Roni, Capital',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '300 Owner’s Equity',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '311',
                    'name_of_accounts'      => 'Mr. Roni, Drawing',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '300 Owner’s Equity',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '410',
                    'name_of_accounts'      => 'Sales',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '400 Revenue',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '411',
                    'name_of_accounts'      => 'Sales Return',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '400 Revenue',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '412',
                    'name_of_accounts'      => 'Sales Discount',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '400 Revenue',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '413',
                    'name_of_accounts'      => 'Purchases',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '400 Revenue',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '414',
                    'name_of_accounts'      => 'Purchases Return',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '400 Revenue',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '415',
                    'name_of_accounts'      => 'Purchases Discount',
                    'debit' 		        => 'decrease',
                    'credit'		        => 'increase',
                    'balance' 	            => 'credit',
                    'grouping' 	            => '400 Revenue',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '510',
                    'name_of_accounts'      => 'Sales Delivery Expense',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '511',
                    'name_of_accounts'      => 'Purchases Delivery Expense',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '512',
                    'name_of_accounts'      => 'Depreciation Expense - Office Equipment',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '513',
                    'name_of_accounts'      => 'Depreciation Expense - Office Vehicles',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '514',
                    'name_of_accounts'      => 'Salaries Expense',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '515',
                    'name_of_accounts'      => 'Phone and Electricity Expense',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ],[
                    'number_of_accounts'    => '516',
                    'name_of_accounts'      => 'Supplies Expense',
                    'debit' 		        => 'increase',
                    'credit'		        => 'decrease',
                    'balance' 	            => 'debit',
                    'grouping' 	            => '500 Expenses',
                    'created_at' 	        => date('Y-m-d H:i:s'),
                    'updated_at' 	        => date('Y-m-d H:i:s'),
                ]
            ];
        if(DB::table('cart_of_accounts')->get()->count() == 0){
            DB::table('cart_of_accounts')->insert($coaData);
        }
    	
        // used to call extended database seed
        // $this->call(UsersTableSeeder::class);
        $this->call(FakerDataSeeder::class);
    }
}
