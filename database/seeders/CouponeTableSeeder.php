<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class CouponeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
            'id'=>1,
            'coupon_option'=>'Manual',
            'coupon_code'=>'test10',
            'products'=>'1',
            'users'=>'ola@gmail.com',
            'coupon_type'=>'singletime',
            'amount_type'=>'Percentage',
            'amount'=>'10',
            'expiry_date'=>'2022-6-2',
            'status'=>1,
            ],
        ]);
        }
}
