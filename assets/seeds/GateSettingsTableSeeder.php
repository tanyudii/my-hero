<?php

use Illuminate\Database\Seeder;

class GateSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateSettings = [];

        foreach (config('smoothsystem.models.role')::where('is_special', 0)->pluck('code') as $roleCode) {
            array_push($gateSettings, [
                'role_code' => $roleCode,
                'permission_ids' => config('smoothsystem.models.permission')::pluck('id'),
            ]);
        }

        foreach ($gateSettings as $gateSetting) {
            $permissionIds = $gateSetting['permission_ids'];
            unset($gateSetting['permission_ids']);

            if (isset($gateSetting['role_code'])) {
                $role = config('smoothsystem.models.role')::where('code', $gateSetting['role_code'])->firstOrFail();
                $gateSetting['role_id'] = $role->id;
                unset($gateSetting['role_code']);
            }

            if (@$gateSetting['email']) {
                $user = config('smoothsystem.models.user')::where('email', @$gateSetting['email'])->firstOrFail();
                $gateSetting['user_id'] = $user->id;
                unset($gateSetting['email']);
            }

            $gateSettings = config('smoothsystem.models.gate_setting')::create($gateSetting);

            $gateSettings->permissions()->sync($permissionIds);
        }
    }
}
