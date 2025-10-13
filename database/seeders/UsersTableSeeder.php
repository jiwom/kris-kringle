<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = json_decode(file_get_contents(base_path('users.json')), true);
        if ($users) {
            foreach ($users as $user) {
                DB::table('users')->insert([
                    'name'      => $user['name'],
                    'password'  => Hash::make($user['password']),
                    'picked_id' => $user['picked_id'],
                    'wishes'    => $user['wishes'],
                    'cluster'   => $user['cluster'],
                ]);
            }
        }
    }
}
