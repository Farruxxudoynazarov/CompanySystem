<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        
        //    admin va company uc uchun ruxsatlar
        
        $permissions = [
            'create companies', 
            'view companies', 
            'edit companies', 
            'delete companies',
            'create employees', 
            'view employees', 
            'edit employees', 
            'delete employees',
            'view own employees', 
            'edit own employees', 
            'create own employees', 
            'delete own employees',
            'view edit own company',
            'edit own company'
        ];
        
        
        foreach ($permissions as $permission){
             Permission::create(['name' => $permission]);
        }
        
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo([
            'view companies', 
            'edit companies', 
            'create companies', 
            'delete companies',
            'create own employees', 
            'view employees',
        ]);
        // Role::findByName('admin')->givePermissionTo('create employee')

        // Birinchi foydalanuvchiga admin rolini berish
     




            // Company rol va uning ruxsatlarini yaratish 
            
            $companyRole = Role::create(['name' => 'company', 'guard_name' => 'web']);

            $companyRole->givePermissionTo([
                'view own employees', 
                'edit own employees', 
                'create own employees', 
                'delete own employees',                
                'view edit own company',
                'delete employees',
                'edit employees',
                'edit own company',
                'create employees'
            ]);    
        }
}
