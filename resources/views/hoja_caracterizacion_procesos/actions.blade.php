{!! Form::open(['route' => ['hojaCaracterizacionProcesos.destroy', $company_id, $process_map_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @can('ver_hojaCaracterizacionProcesos')
            @if ($adjunto==true)
                <button type="button" class="btn btn-default btn-xs"
                    data-toggle="modal" data-target="#uploadModal"
                    data-whatever="{{$id}}">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </button>
                <a href="/storage/{{$data}}" class='btn btn-default btn-xs' target="_blank">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
            @else
                <a href="{{ route('hojaCaracterizacionProcesos.edit', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-edit"></i>
                </a>
                <a href="{{ route('hojaCaracterizacionProcesos.show', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-eye"></i>
                </a>
            @endif
        @endcan
        @can('eliminar_hojaCaracterizacionProcesos')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan

    </div>

{!! Form::close() !!}
