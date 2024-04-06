<?php

namespace Database\Seeders;


use App\Models\Rights\Helper\Permission as PermissionConst;
use App\Models\Rights\Helper\Role as RoleConst;
use App\Models\User\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws Exception
     */
    public function run(): void
    {
        $this->setUser();

        $this->call([
            InfoBlockSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            PageSeeder::class,
        ]);
    }

    /**
     * @return void
     */
    public function setUser(): void
    {
        $adminRole = Role::query()->where('name', RoleConst::ADMINISTRATOR)->first()
            ?: Role::create(['name' => RoleConst::ADMINISTRATOR]);
        $employeeRole = Role::query()->where('name', RoleConst::EMPLOYEE)->first()
            ?: Role::create(['name' => RoleConst::EMPLOYEE]);
        $permission = Permission::query()->where('name', PermissionConst::ENTRY_ALLOWED)->first()
            ?: Permission::create(['name' => PermissionConst::ENTRY_ALLOWED]);
        $permission->assignRole($adminRole);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@yandex.ru'],
            [
                'password_hash' => bcrypt('securepass'),
                'first_name' => 'Admin',
                'last_name' => 'Adminer',
                'status' => 10,
            ]
        );
        $adminUser->assignRole(RoleConst::ADMINISTRATOR);
        $adminUser->assignRole(RoleConst::EMPLOYEE);
        Auth::loginUsingId($adminUser->id);
    }
}
