{!! Form::open(['route' => ['supplyChainCustomers.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('eliminar_cliente_cadena_suministro')
        {!! Form::button('<i class="far fa-trash-alt">Eliminar</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    @endcan
    </div>
{!! Form::close() !!}
