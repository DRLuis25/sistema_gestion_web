{!! Form::open(['route' => ['businessUnits.destroy', $company_id, $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('businessUnits.show', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
        <i class="far fa-eye"></i>
    </a>
    <a href="{{ route('businessUnits.edit', [$company_id, $id]) }}" class='btn btn-default btn-xs'>
        <i class="far fa-edit"></i>
    </a>
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
    </div>
{!! Form::close() !!}
