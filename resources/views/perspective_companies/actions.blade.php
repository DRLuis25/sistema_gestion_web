{!! Form::open(['route' => ['perspectiveCompanies.destroy', $company_id, $id], 'method' => 'delete']) !!}
    <div class='btn-group'>

        <a href="{{ route('perspectiveCompanies.edit', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-edit"></i>
        </a>
        <a href="{{ route('perspectiveCompanies.show', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
            <i class="far fa-eye"></i>
        </a>
        @can('eliminar_perspectiva_empresa')
            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
        @endcan
    </div>
{!! Form::close() !!}
