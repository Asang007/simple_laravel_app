<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            $user_role_admin = new UserRole();
            $user_role_admin->user_id = '1';
            $user_role_admin->position = 'Admin'; 
            $user_role_admin->save();

            $user_role_employee = new UserRole();
            $user_role_employee->user_id = '2';
            $user_role_employee->position = 'Employee'; 
            $user_role_employee->save();

            $user_role_manager = new UserRole();
            $user_role_manager->user_id = '3';
            $user_role_manager->position = 'Manager'; 
            $user_role_manager->save();

            DB::commit();
            Log::info('Seed transaction for initial user role data success');
        } catch (Exception $error) {
            Log::error('Error seeding initial user role data');
            Log::error($error);
            DB::rollBack();
            throw new Exception($error);
        }
    }
}
