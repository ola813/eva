<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                
                'id' => 1,
                'user_id' => 'EMQ-00000',
                'fname' =>'super',
                'lname' =>'admin',
                'email' =>'ALkani@eva.online',
                'password' => bcrypt('EFR345@234'),
                'phone' => '123456789',
                'role_as' => '0',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [

                'id' => 2,
                'user_id' => 'EMQ-00013',
                'fname' =>'ola',
                'lname' =>'salloh',
                'email' =>'lalosh43@eva.on',
                'password' => bcrypt('LOLOeva@#$123'),
                'phone' => '12345678',
                'role_as' => '1',
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
        
        ]);
        DB::table('categories')->insert([
            [
                
                'id' => 1,
                'title_en' =>'pupge',
                'category_ar' =>'game',
                
                'category_en' => 'game',
                'photo' => '123.png',
                'created_at' =>now(),
                'updated_at' =>now(),
                ]
            ]);
            DB::table('company')->insert([
                [
                    
                    'id' => 1,
                    'name'=>'Syrialte',
                    'created_at' =>now(),
                    'updated_at' =>now(),
                ],
                [
                    
                    'id' => 2,
                    'name'=>'MTN',
                    'created_at' =>now(),
                    'updated_at' =>now(),
                    ]
                ]);
         
            
       
   
        $this->call(CouponeTableSeeder::class);
}
}
