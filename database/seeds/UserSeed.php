<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 50, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$W8SGWlrlSyKz9zDwR5LgbeHMjrToqURbJsLPC1DiMXkGlzFqhwXv2', 'role_id' => 1, 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\Models\User::create($item);
        }
    }
}
