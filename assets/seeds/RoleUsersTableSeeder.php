<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'admin@gmail.com' => 'admin',
            'user@gmail.com' => 'user',
        ];

        foreach ($users as $email => $role) {
            $role = config('hero.models.role')::where('code', $role)->firstOrFail();
            $user = config('hero.models.user')::where('email', $email)->firstOrFail();

            $user->roleUsers()->create([
                'role_id' => $role->id,
                'valid_from' => Carbon::now(),
            ]);
        }
    }
}
