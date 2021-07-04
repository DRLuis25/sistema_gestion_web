{!! Form::open(['route' => ['supplyChainSuppliers.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>

    {{-- <a href="{{ route('supplyChainSuppliers.edit', [$id]) }}" class='btn btn-default btn-xs'>
        <i class="far fa-edit">(mal)</i>
    </a> --}}
    {!! Form::button('<i class="far fa-trash-alt">Eliminar</i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    </div>
{!! Form::close() !!}
