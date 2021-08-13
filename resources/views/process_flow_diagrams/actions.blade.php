{!! Form::open(['route' => ['processFlowDiagrams.destroy', $company_id, $process_map_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>
        @can('leer_diagrama_flujo')
            @if ($adjunto==true)
                <a href="/storage/{{$data}}" target="_blank" class='btn btn-default btn-xs'>
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
            @else
                <a href="{{ route('processFlowDiagrams.edit', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-edit"></i>
                </a>
                <a href="{{ route('processFlowDiagrams.show', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-eye"></i>
                </a>
            @endif
        @endcan
        @can('eliminar_diagrama_flujo')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan
    </div>
{!! Form::close() !!}
