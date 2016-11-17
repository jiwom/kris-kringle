<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = json_decode(file_get_contents('users.json'),true);
        foreach($users as $user){
            DB::table('users')->insert([
                'name' => $user['name'],
                'password' => $user['password'],
                'picked_id' => $user['picked_id'],
                'wishes' => $user['wishes'],
            ]);
        }
    }
}
