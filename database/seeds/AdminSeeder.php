<?php

use Illuminate\Database\Seeder;
use App\AdminModel;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AdminModel::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'avatar' => '/images/upload/image-1641369664.jpg',
            'password' => bcrypt('admin'),
            'role_id' => 1
        ]);
        /*for($i =0; $i<=20; $i++){
            AdminModel::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('12345678'),
                'role_id' => random_int(1,5)
            ]);
        }*/
    }
}
