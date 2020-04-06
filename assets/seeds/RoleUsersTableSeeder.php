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
            'admin@ss.com' => 'admin',
            'user@ss.com' => 'user',
        ];

        foreach ($users as $email => $role) {
            $role = config('smoothsystem.models.role')::where('code', $role)->firstOrFail();
            $user = config('smoothsystem.models.user')::where('email', $email)->firstOrFail();

            $user->roleUsers()->create([
                'role_id' => $role->id,
                'valid_from' => Carbon::now(),
            ]);
        }
    }
}
