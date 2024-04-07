<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Company;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    
    public function run(): void
    {
        $company_id = Company::findOrFail(1);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminparol'),
            // 'role_id' => 1,
        ]);


        $adminRole = Role::firstOrCreate(['name' =>'admin', 'guard_name' =>'web']);
        $admin->assignRole($adminRole);



       $company = User::create([
            'name'=> 'Company',
            'email' => 'company@example.com',
            'password' => Hash::make('companyparol'),
            'company_id' => $company_id->id,  // Foydalanuvchini birinchi kompaniyaga bog'lash

            // 'company_id' => $company->id,
        ]);
        
        // $company = Company::findOrFail(1);

        $companyRole = Role::firstOrCreate(['name' => 'company', 'guard_name' => 'web']);

        $company->assignRole($companyRole);

    }
}

