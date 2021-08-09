{!! Form::open(['route' => ['destroyProcessFlowDiagramRedesign', $company_id, $process_map_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>

        @can('ver_diagrama_flujo')
            @if ($redesing_boolean==false)
                <button type="button" class="btn btn-default btn-xs"
                    data-toggle="modal" data-target="#uploadModal"
                    data-whatever="{{$id}}">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </button>
                <a href="{{route('createRedesign',[$company_id,$process_map_id,$id])}}" class='btn btn-default btn-xs'>
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            @else
                @if ($redesing_adjunto==false)
                    <a href="{{ route('editRedesign', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="{{ route('showRedesign', [$company_id, $process_map_id, $id]) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-eye"></i>
                    </a>

                @else
                    <button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#uploadModal"
                        data-whatever="{{$id}}">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </button>
                    <a href="/storage/{{$redesign_file}}" class='btn btn-default btn-xs' target="_blank">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                @endif
                @can('eliminar_diagrama_flujo')
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                @endcan
            @endif
        @endcan
    </div>
{!! Form::close() !!}
