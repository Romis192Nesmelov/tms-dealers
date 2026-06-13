<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'romis.nesmelov@gmail.com',
                'password' => bcrypt('apg192'),
                'is_admin' => 1
            ],
            [
                'email' => 'danila.solodovnikov@titan-ms.ru',
                'password' => bcrypt('danila'),
                'is_admin' => 1
            ],
        ];

        foreach ($users as $user) {
            User::query()->create($user);
        }
    }
}
