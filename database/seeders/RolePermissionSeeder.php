<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage categories',
            'manage company',
            'manage jobs',
            'manage candidates',
            'apply job',
            'perusahaan',
           'company_users',
 
           'manage links'
        ];

        // Create or find permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // Create or find roles and assign permissions
        $employerRole = Role::firstOrCreate(['name' => 'employer']);
        $employerPermissions = ['manage company', 'manage jobs', 'manage candidates','manage categories'];
        $employerRole->syncPermissions($employerPermissions);

        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $employeePermissions = ['apply job'];
        $employeeRole->syncPermissions($employeePermissions);

        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        // $superAdminPermissions = ['manage company', 'manage jobs', 'manage candidates', 'manage categories', 'perusahaan', 'company_users', 'webinar', 'psikotes', 'manage-questions', 'manage links'];
        // $superAdminRole->syncPermissions($superAdminPermissions);

        // Create a super admin user and assign the super admin role
        $user = User::firstOrCreate([
            'email' => 'super@admin.com'
        ], [
            'name' => 'Super Admin',
            'occupation' => 'Superadmin',
            'experience' => 100,
            'avatar' => 'images/default-avatar.png',
            'password' => Hash::make('1234567890'),
            'email_verified_at' => Carbon::now(),  // Menandakan email sudah terverifikasi
        ]);

        $user->assignRole($superAdminRole);
    }
}
