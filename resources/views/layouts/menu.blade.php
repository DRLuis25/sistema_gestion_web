@if (Request::is('companies*','home','users*','roles*','audits*'))
    <li class="nav-item has-treeview {{ Request::is('companies*','users*','roles*','audits*') ? 'menu-open' : '' }}">
        <a href="" class="nav-link inactive">
            <i class="nav-icon fas fa-code"></i>
            <p>
                Administrar
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: {{ Request::is('companies*','users*','roles*','audits*') ? 'block' : 'none' }}">

                <li class="nav-item">
                    <a href="{{ route('companies.index') }}"
                    class="nav-link {{ Request::is('companies*') ? 'active' : '' }}">
                        <p>@lang('models/companies.plural')</p>
                    </a>
                </li>


            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                    <p>@lang('models/users.plural')</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('roles.index') }}"
                class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                    <p>@lang('models/roles.plural')</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('audits.index') }}"
                class="nav-link {{ Request::is('audits*') ? 'active' : '' }}">
                    <p>@lang('models/audits.plural')</p>
                </a>
            </li>
        </ul>
    </li>
@endif
@if ((Request::is('company*','suppliers*','customers*','businessUnits*','supplyChains*') and !Request::is('*processMaps/*')) or Request::is('*processMaps/create'))

        <li class="nav-item">
            {{-- <a href="{{ route('suppliers.index') }}" --}}
            <a href="{{ route('company.showCompany', [$company_id]) }}"
            class="nav-link {{ Request::is('company') ? 'active' : '' }}">
                <p>Información</p>
            </a>
        </li>
    {{-- @canany(['crear_proveedores', 'leer_proveedores', 'modificar_proveedores','eliminar_proveedores'])
        <li class="nav-item">
            <a href="{{ route('suppliers.index', [$company_id]) }}"
            class="nav-link {{ Request::is('*suppliers') ? 'active' : '' }}">
                <p>@lang('models/suppliers.plural')</p>
            </a>
        </li>
    @endcan
    @canany(['crear_clientes', 'leer_clientes', 'modificar_clientes','eliminar_clientes'])
        <li class="nav-item">
            <a href="{{ route('customers.index', [$company_id]) }}"
            class="nav-link {{ Request::is('*customers') ? 'active' : '' }}">
                <p>@lang('models/customers.plural')</p>
            </a>
        </li>
    @endcan --}}
    @canany(['crear_unidad_de_negocio', 'leer_unidad_de_negocio', 'modificar_unidad_de_negocio','eliminar_unidad_de_negocio'])
        <li class="nav-item">
            <a href="{{ route('businessUnits.index', [$company_id]) }}"
            class="nav-link {{ Request::is('*businessUnits') ? 'active' : '' }}">
                <p>@lang('models/businessUnits.plural')</p>
            </a>
        </li>
    @endcan
    {{-- @canany(['crear_cadena_suministro', 'modificar_cadena_suministro', 'eliminar_cadena_suministro','registrar_proveedor_cadena_suministro','eliminar_proveedor_cadena_suministro','registrar_cliente_cadena_suministro','eliminar_cliente_cadena_suministro','ver_grafico_cadena_suministro','exportar_grafico_cadena_suministro','crear_historial_cadena_suministro','leer_historial_cadena_suministro','eliminar_historial_cadena_suministro'])
        <li class="nav-item">
            <a href="{{ route('supplyChains.index', [$company_id]) }}"
            class="nav-link {{ Request::is('*supplyChains') ? 'active' : '' }}">
                <p>@lang('models/supplyChains.plural')</p>
            </a>
        </li>
    @endcan --}}
    <li class="nav-item">
        <a href="{{ route('processMaps.index', [$company_id]) }}"
           class="nav-link {{ Request::is('processMaps*') ? 'active' : '' }}">
            <p>@lang('models/processMaps.plural')</p>
        </a>
    </li>

@endif

@if ((Request::is('*processMaps/*') and !Request::is('*processMaps/create'))or Request::is('historialProcessMaps*'))
    <li class="nav-item">
        <a href="{{ route('processMaps.index', [$company_id]) }}"
        class="nav-link {{ Request::is('processMaps*') ? 'active' : '' }}">
            <p>@lang('models/processMaps.plural')</p>
        </a>
    </li>
    <ul class="nav-sidebar">
        <li class="nav-item">
            <a href="{{ route('processMaps.show', [$company_id, $process_map_id]) }}"
            class="nav-link {{ Request::is('processMaps*') ? 'active' : '' }}">
                <p>@lang('models/processMaps.singular')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('criterios.index', [$company_id, $process_map_id]) }}"
            class="nav-link {{ Request::is('*criterios*') ? 'active' : '' }}">
                <p>@lang('models/criterios.plural')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('processCriterios.index', [$company_id, $process_map_id]) }}"
            class="nav-link {{ Request::is('*processCriterios*') ? 'active' : '' }}">
                <p>Matriz Priorización</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('matrizPriorizados.index',[$company_id, $process_map_id]) }}"
            class="nav-link {{ Request::is('*matrizPriorizados*') ? 'active' : '' }}">
                <p>@lang('models/matrizPriorizados.plural')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('hojaCaracterizacionProcesos.index',[$company_id, $process_map_id]) }}"
            class="nav-link {{ Request::is('*hojaCaracterizacionProcesos*') ? 'active' : '' }}">
                <p>@lang('models/hojaCaracterizacionProcesos.plural')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('processFlowDiagrams.index',[$company_id, $process_map_id]) }}"
               class="nav-link {{ Request::is('*processFlowDiagrams*') ? 'active' : '' }}">
                <p>@lang('models/processFlowDiagrams.plural')</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seguimientos.index',[$company_id, $process_map_id]) }}"
               class="nav-link {{ Request::is('*seguimientos*') ? 'active' : '' }}">
                <p>@lang('models/seguimientos.singular')</p>
            </a>
        </li>
    </ul>
@endif
{{-- <li class="nav-item">
    <a href="{{ route('seguimientoPropuestos.index') }}"
       class="nav-link {{ Request::is('seguimientoPropuestos*') ? 'active' : '' }}">
        <p>@lang('models/seguimientoPropuestos.plural')</p>
    </a>
</li>


 --}}
{{-- <li class="nav-item">
    <a href="{{ route('subProcesses.index') }}"
       class="nav-link {{ Request::is('subProcesses*') ? 'active' : '' }}">
        <p>@lang('models/subProcesses.plural')</p>
    </a>
</li>


 --}}
