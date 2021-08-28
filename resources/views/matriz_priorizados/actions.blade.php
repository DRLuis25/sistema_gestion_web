<div class='btn-group'>
    @can('leer_matriz_priorizados')
        <a href="{{ route('matrizPriorizados.show', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
    @endcan
    @if ($deleted_at==null)
        {!! Form::open(['route' => ['matrizPriorizados.destroy', $company_id, $process_map_id, $id], 'method' => 'delete']) !!}
            @can('eliminar_matriz_priorizacion')
                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
            @endcan
        {!! Form::close() !!}
    @else
        <form action="{{route('matrizPriorizados.activate',[$company_id, $process_map_id, $id])}}" method="POST">
        @csrf
            @can('eliminar_matriz_priorizacion')
                {!! Form::button('activar', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
            @endcan
        </form>


    @endif

    </div>

