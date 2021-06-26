<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'test']);
        $role2 = Role::create(['name' => 'test2']);
        // $this->call(UsersTableSeeder::class);
        $superAdmin = User::create([
            'dni'=>'74705403',
            'names'=>'Luis Guillermo',
            'lastNamePat'=>'Delgado',
            'lastNameMat'=>'Rodriguez',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $superAdmin->assignRole($role1);
        $superAdmin->assignRole($role2);
    }
}
