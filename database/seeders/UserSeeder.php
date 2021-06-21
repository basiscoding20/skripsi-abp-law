<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = User::count();
        
        if(!$count){
            User::create([
                'name'      => 'Admin',
                'email'     => 'admin@admin.com',
                'role'     => 'administrator',
                'password'  => bcrypt('admin123')
            ]);
        }
    }
}
