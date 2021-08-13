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
        //NUEVOS
        $proceso_role = Role::create(['name' => 'gestionar_proceso']);
        $subproceso_role = Role::create(['name' => 'gestionar_subproceso']);
        $mapa_proceso_role = Role::create(['name' => 'gestionar_mapa_proceso']);
        $historial_mapa_proceso_role = Role::create(['name' => 'gestionar_historial_mapa_proceso']);
        $criterio_role = Role::create(['name' => 'gestionar_criterios']);
        $rol_role = Role::create(['name' => 'gestionar_roles_empresa']);
        $matriz_priorizacion_role = Role::create(['name' => 'gestionar_matriz_priorizacion']);
        $proceso_priorizado_role = Role::create(['name' => 'gestionar_procesos_priorizados']);
        $hoja_caracterizacion_role = Role::create(['name' => 'gestionar_hoja_caracterizacion']);
        $diagrama_flujo_role = Role::create(['name' => 'gestionar_diagrama_flujo']);
        $seguimiento_role = Role::create(['name' => 'gestionar_seguimiento']);

        //PERMISOS

        $proceso_create = Permission::create(['name' => 'crear_proceso']);
        $proceso_read = Permission::create(['name' => 'leer_proceso']);
        $proceso_update = Permission::create(['name' => 'modificar_proceso']);
        $proceso_delete = Permission::create(['name' => 'eliminar_proceso']);

        $subproceso_create = Permission::create(['name' => 'crear_subproceso']);
        $subproceso_read = Permission::create(['name' => 'leer_subproceso']);
        $subproceso_update = Permission::create(['name' => 'modificar_subproceso']);
        $subproceso_delete = Permission::create(['name' => 'eliminar_subproceso']);

        $mapa_proceso_create = Permission::create(['name' => 'crear_mapa_proceso']);
        $mapa_proceso_read = Permission::create(['name' => 'leer_mapa_proceso']);
        $mapa_proceso_update = Permission::create(['name' => 'modificar_mapa_proceso']);
        $mapa_proceso_delete = Permission::create(['name' => 'eliminar_mapa_proceso']);
        $mapa_proceso_export = Permission::create(['name' => 'exportar_grafico_mapa_proceso']);

        $historial_mapa_proceso_create = Permission::create(['name' => 'crear_historial_mapa_proceso']);
        $historial_mapa_proceso_read = Permission::create(['name' => 'leer_historial_mapa_proceso']);
        $historial_mapa_proceso_update = Permission::create(['name' => 'modificar_historial_mapa_proceso']);
        $historial_mapa_proceso_delete = Permission::create(['name' => 'eliminar_historial_mapa_proceso']);

        $criterio_create = Permission::create(['name' => 'crear_criterio']);
        $criterio_read = Permission::create(['name' => 'leer_criterio']);
        $criterio_update = Permission::create(['name' => 'modificar_criterio']);
        $criterio_delete = Permission::create(['name' => 'eliminar_criterio']);

        $rol_create = Permission::create(['name' => 'crear_rol']);
        $rol_read = Permission::create(['name' => 'leer_rol']);
        $rol_update = Permission::create(['name' => 'modificar_rol']);
        $rol_delete = Permission::create(['name' => 'eliminar_rol']);

        $matriz_priorizacion_create = Permission::create(['name' => 'crear_matriz_priorizacion']);
        $matriz_priorizacion_read = Permission::create(['name' => 'leer_matriz_priorizacion']);
        $matriz_priorizacion_update = Permission::create(['name' => 'modificar_matriz_priorizacion']);
        $matriz_priorizacion_delete = Permission::create(['name' => 'eliminar_matriz_priorizacion']);
        $priorizar_procesos_matriz_priorizacion = Permission::create(['name' => 'priorizar_procesos_matriz_priorizacion']);

        $proceso_priorizado_create = Permission::create(['name' => 'crear_proceso_priorizado']);
        $proceso_priorizado_read = Permission::create(['name' => 'leer_proceso_priorizado']);
        $proceso_priorizado_update = Permission::create(['name' => 'modificar_proceso_priorizado']);
        $proceso_priorizado_delete = Permission::create(['name' => 'eliminar_proceso_priorizado']);

        $hoja_caracterizacion_create = Permission::create(['name' => 'crear_hoja_caracterizacion']);
        $hoja_caracterizacion_read = Permission::create(['name' => 'leer_hoja_caracterizacion']);
        $hoja_caracterizacion_update = Permission::create(['name' => 'modificar_hoja_caracterizacion']);
        $hoja_caracterizacion_delete = Permission::create(['name' => 'eliminar_hoja_caracterizacion']);

        $diagrama_flujo_create = Permission::create(['name' => 'crear_diagrama_flujo']);
        $diagrama_flujo_read = Permission::create(['name' => 'leer_diagrama_flujo']);
        $diagrama_flujo_update = Permission::create(['name' => 'modificar_diagrama_flujo']);
        $diagrama_flujo_delete = Permission::create(['name' => 'eliminar_diagrama_flujo']);

        $seguimiento_create = Permission::create(['name' => 'crear_seguimiento']);
        $seguimiento_read = Permission::create(['name' => 'leer_seguimiento']);
        $diagrama_seguimiento_read = Permission::create(['name' => 'leer_diagrama_seguimiento']);
        $seguimiento_update = Permission::create(['name' => 'modificar_seguimiento']);
        $seguimiento_delete = Permission::create(['name' => 'eliminar_seguimiento']);
        //CREAR ARRAY CON PERMISOS
        $proceso_role_permissions = array(
            $proceso_create,
            $proceso_read,
            $proceso_update,
            $proceso_delete,
        );
        $subproceso_role_permissions = array(
            $subproceso_create,
            $subproceso_read,
            $subproceso_update,
            $subproceso_delete,
        );
        $mapa_proceso_role_permissions = array(
            $mapa_proceso_create,
            $mapa_proceso_read,
            $mapa_proceso_update,
            $mapa_proceso_delete,
            $mapa_proceso_export
        );
        $historial_mapa_proceso_role_permissions = array(
            $historial_mapa_proceso_create,
            $historial_mapa_proceso_read,
            $historial_mapa_proceso_update,
            $historial_mapa_proceso_delete,
        );
        $criterio_role_permissions = array(
            $criterio_create,
            $criterio_read,
            $criterio_update,
            $criterio_delete,
        );
        $rol_role_permissions = array(
            $rol_create,
            $rol_read,
            $rol_update,
            $rol_delete,
        );
        $matriz_priorizacion_role_permissions = array(
            $matriz_priorizacion_create,
            $matriz_priorizacion_read,
            $matriz_priorizacion_update,
            $matriz_priorizacion_delete,
            $priorizar_procesos_matriz_priorizacion,
        );
        $proceso_priorizado_role_permissions = array(
            $proceso_priorizado_create,
            $proceso_priorizado_read,
            $proceso_priorizado_update,
            $proceso_priorizado_delete,
        );
        $hoja_caracterizacion_role_permissions = array(
            $hoja_caracterizacion_create,
            $hoja_caracterizacion_read,
            $hoja_caracterizacion_update,
            $hoja_caracterizacion_delete,
        );
        $diagrama_flujo_role_permissions = array(
            $diagrama_flujo_create,
            $diagrama_flujo_read,
            $diagrama_flujo_update,
            $diagrama_flujo_delete,
        );
        $seguimiento_role_permissions = array(
            $seguimiento_create,
            $seguimiento_read,
            $diagrama_seguimiento_read,
            $seguimiento_update,
            $seguimiento_delete,
        );
        //ASIGNAR PERMISOS A ROL
        $proceso_role->syncPermissions($proceso_role_permissions);
        $subproceso_role->syncPermissions($subproceso_role_permissions);
        $mapa_proceso_role->syncPermissions($mapa_proceso_role_permissions);
        $historial_mapa_proceso_role->syncPermissions($historial_mapa_proceso_role_permissions);
        $criterio_role->syncPermissions($criterio_role_permissions);
        $rol_role->syncPermissions($rol_role_permissions);
        $matriz_priorizacion_role->syncPermissions($matriz_priorizacion_role_permissions);
        $proceso_priorizado_role->syncPermissions($proceso_priorizado_role_permissions);
        $hoja_caracterizacion_role->syncPermissions($hoja_caracterizacion_role_permissions);
        $diagrama_flujo_role->syncPermissions($diagrama_flujo_role_permissions);
        $seguimiento_role->syncPermissions($seguimiento_role_permissions);










        //OLD












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
        $cadena_suministro_delete_historial,//NUEVOS
        $proceso_create,
        $proceso_read,
        $proceso_update,
        $proceso_delete,

        $subproceso_create,
        $subproceso_read,
        $subproceso_update,
        $subproceso_delete,

        $mapa_proceso_create,
        $mapa_proceso_read,
        $mapa_proceso_update,
        $mapa_proceso_delete,
        $mapa_proceso_export,

        $historial_mapa_proceso_create,
        $historial_mapa_proceso_read,
        $historial_mapa_proceso_update,
        $historial_mapa_proceso_delete,

        $criterio_create,
        $criterio_read,
        $criterio_update,
        $criterio_delete,

        $rol_create,
        $rol_read,
        $rol_update,
        $rol_delete,

        $matriz_priorizacion_create,
        $matriz_priorizacion_read,
        $matriz_priorizacion_update,
        $matriz_priorizacion_delete,
        $priorizar_procesos_matriz_priorizacion,

        $proceso_priorizado_create,
        $proceso_priorizado_read,
        $proceso_priorizado_update,
        $proceso_priorizado_delete,

        $hoja_caracterizacion_create,
        $hoja_caracterizacion_read,
        $hoja_caracterizacion_update,
        $hoja_caracterizacion_delete,

        $diagrama_flujo_create,
        $diagrama_flujo_read,
        $diagrama_flujo_update,
        $diagrama_flujo_delete,

        $seguimiento_create,
        $seguimiento_read,
        $seguimiento_update,
        $seguimiento_delete,
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

        $this->call(RolesSeeder::class);

        $this->call(MapaProcesoSeeder::class);
    }
}
