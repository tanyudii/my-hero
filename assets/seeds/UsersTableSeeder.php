<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
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
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('asdasdasd'),
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('asdasdasd'),
            ],
        ];

        foreach ($users as $index => $user) {
            if ($index != 0) {
                $user['created_by'] = 1;
                $user['updated_by'] = 1;
            }

            $user['email_verified_at'] = Carbon::now();
            $user['remember_token'] = Str::random(10);

            config('hero.models.user')::create($user);
        }
    }
}
