<?php

use App\Models\businessUnit;
use App\Models\Company;
use App\Models\Customer;
use App\Models\processMap;
use App\Models\Supplier;
use App\Models\Type;
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
        $admin_role = Role::create(['name' => 'admin']);
        $supplier_role = Role::create(['name' => 'gestionar proveedores']);
        $customer_role = Role::create(['name' => 'gestionar clientes']);
        $business_unit_role = Role::create(['name' => 'gestionar unidad negocio']);
        $supply_chain_role = Role::create(['name' => 'gestionar cadena suministro']);
        $supply_chain_supplier_role = Role::create(['name' => 'gestionar proveedores cadena suministro']);
        $supply_chain_customer_role = Role::create(['name' => 'gestionar clientes cadena suministro']);
        $supply_chain_graphic_role = Role::create(['name' => 'gestionar grafico cadena suministro']);
        $supply_chain_historial_role = Role::create(['name' => 'gestionar historial cadena suministro']);

        //Esto solo lo hace el super Admin
        //$admin_empresas = Permission::create(['name' => 'administrar_empresa']);
        /* $empresa_create = Permission::create(['name' => 'crear_empresas']);
        $empresa_read = Permission::create(['name' => 'leer_empresas']);
        $empresa_update = Permission::create(['name' => 'modificar_empresas']);
        $empresa_delete = Permission::create(['name' => 'eliminar_empresas']); */
        //$admin_proveedores = Permission::create(['name' => 'administrar_proveedores']);
        $proveedor_create = Permission::create(['name' => 'crear_proveedores']);
        $proveedor_read = Permission::create(['name' => 'leer_proveedores']);
        $proveedor_update = Permission::create(['name' => 'modificar_proveedores']);
        $proveedor_delete = Permission::create(['name' => 'eliminar_proveedores']);
        //$admin_clientes = Permission::create(['name' => 'administrar_clientes']);
        $cliente_create = Permission::create(['name' => 'crear_clientes']);
        $cliente_read = Permission::create(['name' => 'leer_clientes']);
        $cliente_update = Permission::create(['name' => 'modificar_clientes']);
        $cliente_delete = Permission::create(['name' => 'eliminar_clientes']);
        //$admin_unidad_negocio = Permission::create(['name' => 'administrar_unidad_negocio']);
        $unidad_negocio_create = Permission::create(['name' => 'crear_unidad_de_negocio']);
        $unidad_negocio_read = Permission::create(['name' => 'leer_unidad_de_negocio']);
        $unidad_negocio_update = Permission::create(['name' => 'modificar_unidad_de_negocio']);
        $unidad_negocio_delete = Permission::create(['name' => 'eliminar_unidad_de_negocio']);
        //$admin_cadena_suministro = Permission::create(['name' => 'administrar_cadena_suministro']);
        $cadena_suministro_create = Permission::create(['name' => 'crear_cadena_suministro']);
        $cadena_suministro_update = Permission::create(['name' => 'modificar_cadena_suministro']);
        $cadena_suministro_delete = Permission::create(['name' => 'eliminar_cadena_suministro']);
        //Ver detalle cadena suministro
        //$cadena_suministro_read = Permission::create(['name' => 'leer_cadena_suministro']); //este no creo
        //Nav Proveedor Cadena Suministro
        $cadena_suministro_create_supplier = Permission::create(['name' => 'registrar_proveedor_cadena_suministro']);
        $cadena_suministro_delete_supplier = Permission::create(['name' => 'eliminar_proveedor_cadena_suministro']);
        //Nav Cliente Cadena Suministro
        $cadena_suministro_create_customer = Permission::create(['name' => 'registrar_cliente_cadena_suministro']);
        $cadena_suministro_delete_customer = Permission::create(['name' => 'eliminar_cliente_cadena_suministro']);
        //Nav gráfico
        $cadena_suministro_read_graphic = Permission::create(['name' => 'ver_grafico_cadena_suministro']);
        $cadena_suministro_export_graphic = Permission::create(['name' => 'exportar_grafico_cadena_suministro']);
        $cadena_suministro_create_historial = Permission::create(['name' => 'crear_historial_cadena_suministro']);
        //Nav Historial
        $cadena_suministro_read_historial = Permission::create(['name' => 'leer_historial_cadena_suministro']);
        $cadena_suministro_delete_historial = Permission::create(['name' => 'eliminar_historial_cadena_suministro']);
        $admin_role_permissions = array(/*$empresa_create,
        $empresa_read,
        $empresa_update,
        $empresa_delete,*/
        $proveedor_create,
        $proveedor_read,
        $proveedor_update,
        $proveedor_delete,
        $cliente_create,
        $cliente_read,
        $cliente_update,
        $cliente_delete,
        $unidad_negocio_create,
        $unidad_negocio_read,
        $unidad_negocio_update,
        $unidad_negocio_delete,
        $cadena_suministro_create,
        $cadena_suministro_update,
        $cadena_suministro_delete,
        $cadena_suministro_create_supplier,
        $cadena_suministro_delete_supplier,
        $cadena_suministro_create_customer,
        $cadena_suministro_delete_customer,
        $cadena_suministro_read_graphic,
        $cadena_suministro_export_graphic,
        $cadena_suministro_create_historial,
        $cadena_suministro_read_historial,
        $cadena_suministro_delete_historial
        );
        $supplier_role_permissions = array(
            $proveedor_create,
            $proveedor_read,
            $proveedor_update,
            $proveedor_delete,
        );
        $customer_role_permissions = array(
            $cliente_create,
            $cliente_read,
            $cliente_update,
            $cliente_delete,
        );
        $business_unit_role_permissions = array(
            $unidad_negocio_create,
            $unidad_negocio_read,
            $unidad_negocio_update,
            $unidad_negocio_delete,
        );
        $supply_chain_role_permissions = array(
            $cadena_suministro_create,
            $cadena_suministro_update,
            $cadena_suministro_delete,
        );
        $supply_chain_supplier_role_permissions = array(
            $cadena_suministro_create_supplier,
            $cadena_suministro_delete_supplier,
        );
        $supply_chain_customer_role_permissions = array(
            $cadena_suministro_create_customer,
            $cadena_suministro_delete_customer,
        );
        $supply_chain_graphic_role_permissions = array(
            $cadena_suministro_read_graphic,
            $cadena_suministro_export_graphic,
        );
        $supply_chain_historial_role_permissions = array(
            $cadena_suministro_create_historial,
            $cadena_suministro_read_historial,
            $cadena_suministro_delete_historial
        );
        $superAdmin = User::create([
            'dni'=>'74705403',
            'names'=>'Luis Guillermo',
            'lastNamePat'=>'Delgado',
            'lastNameMat'=>'Rodriguez',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'is_admin' => '1',
        ]);
        $admin_role->syncPermissions($admin_role_permissions);
        $supplier_role->syncPermissions($supplier_role_permissions);
        $customer_role->syncPermissions($customer_role_permissions);
        $business_unit_role->syncPermissions($business_unit_role_permissions);
        $supply_chain_role->syncPermissions($supply_chain_role_permissions);
        $supply_chain_supplier_role->syncPermissions($supply_chain_supplier_role_permissions);
        $supply_chain_customer_role->syncPermissions($supply_chain_customer_role_permissions);
        $supply_chain_graphic_role->syncPermissions($supply_chain_graphic_role_permissions);
        $supply_chain_historial_role->syncPermissions($supply_chain_historial_role_permissions);
        $usuarios = factory(User::class,100)->create()->each(function ($item, $key)
        {
            $item->assignRole('admin');
        });
        $companies = factory(Company::class,10)->create();
        $customers = factory(Customer::class,10)->create();
        $suppliers = factory(Supplier::class,10)->create();


        $this->call(MapaProcesoSeeder::class);
    }
}
