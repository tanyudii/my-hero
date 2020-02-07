<?php

use Illuminate\Database\Seeder;

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
            'admin@ss.id' => 'admin',
            'user@ss.id' => 'user',
        ];

        foreach ($users as $email => $roleCode) {
            $role = roleClass()::where('code', $roleCode)->first();
            $user = userClass()::where('email', $email)->first();

            if ($user && $role) {
                roleUserClass()::create([
                    'role_id' => $role->id,
                    'user_id' => $user->id,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
