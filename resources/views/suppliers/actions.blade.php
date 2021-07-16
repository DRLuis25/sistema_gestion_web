{!! Form::open(['route' => ['suppliers.destroy', $company_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @can('leer_proveedores')
            <a href="{{ route('suppliers.show', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
                <i class="far fa-eye"></i>
            </a>
        @endcan
        @can('modificar_proveedores')
            <a href="{{ route('suppliers.edit', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
                <i class="far fa-edit"></i>
            </a>
        @endcan
        @can('eliminar_proveedores')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan
    </div>
{!! Form::close() !!}
