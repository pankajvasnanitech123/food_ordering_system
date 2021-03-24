<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class WaiterCashierUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pankaj Waiter',
            'email' => 'pankaj_waiter@mailinator.com',
            'password' => \Hash::make('Syste@123'),
            'user_role_id' => config('constants.user_types.waiter'),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Pankaj Cashier',
            'email' => 'pankaj_cashier@mailinator.com',
            'password' => \Hash::make('Syste@123'),
            'user_role_id' => config('constants.user_types.cashier'),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
