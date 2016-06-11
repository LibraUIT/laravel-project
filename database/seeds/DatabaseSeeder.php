<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'group' => 1
        ]);

        $this->some_user();

        Model::reguard();
    }

    public function some_user()
    {
       $i = 0;
       while ( $i <= 10) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('password')
            ]);
            $i++;
       }

    }
}
