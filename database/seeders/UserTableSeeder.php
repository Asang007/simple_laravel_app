<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultPassword = Hash::make('123456');

        try {
            DB::beginTransaction();

            $admin_user = new User();
            $admin_user->name = 'Kevin Mustafa';
            $admin_user->email = 'kevinmustafa1993@gmail.com';
            $admin_user->password = $defaultPassword;
            $admin_user->save();

            $employee_user = new User();
            $employee_user->name = 'Kevin Employee';
            $employee_user->email = 'kevinemployee@gmail.com';
            $employee_user->password = $defaultPassword;
            $employee_user->save();

            $manager_user = new User();
            $manager_user->name = 'Kevin Manager';
            $manager_user->email = 'kevinmanager@gmail.com';
            $manager_user->password = $defaultPassword;
            $manager_user->save();

            DB::commit();
            Log::info('Seed transaction for initial user data success');
        } catch (Exception $error) {
            Log::error('Error seeding initial user data');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }
}
