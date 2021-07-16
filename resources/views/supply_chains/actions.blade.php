{!! Form::open(['route' => ['supplyChains.destroy', $company_id, $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @canany(['registrar_proveedor_cadena_suministro',
    'eliminar_proveedor_cadena_suministro',
    'registrar_cliente_cadena_suministro',
    'eliminar_cliente_cadena_suministro',
    'ver_grafico_cadena_suministro',
    'exportar_grafico_cadena_suministro',
    'crear_historial_cadena_suministro',
    'leer_historial_cadena_suministro',
    'eliminar_historial_cadena_suministro'])
        <a href="{{ route('supplyChains.show', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @can('modificar_cadena_suministro')
        <a href="{{ route('supplyChains.edit', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-edit"></i>
        </a>
    @endcan
    {{-- @can('eliminar_cadena_suministros')
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan --}}
    </div>
{!! Form::close() !!}
