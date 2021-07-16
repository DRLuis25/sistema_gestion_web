{!! Form::open(['route' => ['customers.destroy', $company_id, $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('leer_clientes')
        <a href="{{ route('customers.show', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @can('modificar_clientes')
        <a href="{{ route('customers.edit', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-edit"></i>
        </a>
    @endcan
    @can('eliminar_clientes')
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan
    </div>
{!! Form::close() !!}
