<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09980730638',
            'address'=>'Yangon',
            'gender'=>'male',
            'role'=>'admin',
            'position'=>'CEO',
            'NRC'=>'၁၂/မဂဒ(နိုင်)၁၉၅၁၆၇',
            'enrollments_status'=>0,
            'password'=>Hash::make('admin0912')
         ]);

         User::create([
             'name'=>'User',
             'email'=>'user@gmail.com',
             'phone'=>'09757589796',
             'address'=>'Yangon',
             'gender'=>'male',
             'role'=>'user',
             'position'=>'HR',
            'NRC'=>'၁၂/မဂဒ(နိုင်)၁၉၅၁၆၈',
             'enrollments_status'=>0,
             'password'=>Hash::make('user0912')
          ]);

          User::create([
            'name'=>'Customer',
            'email'=>'customer@gmail.com',
            'phone'=>'09680889279',
            'address'=>'Yangon',
            'gender'=>'male',
            'role'=>'customer',
            'password'=>Hash::make('customer0912')
         ]);
    }
}
