<?php

use App\Models\Company;
use App\Models\Customer;
use App\Models\Supplier;
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
        $normal_user = Role::create(['name' => 'user']);
        $admin_empresas = Permission::create(['name' => 'admin_empresas']);
        $admin_proveedores = Permission::create(['name' => 'admin_proveedores']);
        $admin_clientes = Permission::create(['name' => 'admin_clientes']);
        $admin_unidad_negocio = Permission::create(['name' => 'admin_unidad_negocio']);
        $admin_cadena_suministro = Permission::create(['name' => 'admin_cadena_suministro']);
        $normalUserPermissions = array($admin_empresas, $admin_proveedores, $admin_clientes, $admin_unidad_negocio, $admin_cadena_suministro);        // $this->call(UsersTableSeeder::class);
        $superAdmin = User::create([
            'dni'=>'74705403',
            'names'=>'Luis Guillermo',
            'lastNamePat'=>'Delgado',
            'lastNameMat'=>'Rodriguez',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'isSuperAdmin' => '1',
        ]);
        $normal_user->syncPermissions($normalUserPermissions);
        $usuarios = factory(User::class,100)->create()->each(function ($item, $key)
        {
            $item->assignRole('user');
        });
        $usuarios = factory(Company::class,10)->create();
        $usuarios = factory(Customer::class,10)->create();
        $usuarios = factory(Supplier::class,10)->create();
    }
}
