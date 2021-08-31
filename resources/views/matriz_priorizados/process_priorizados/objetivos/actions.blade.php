<form action="{{route('objectives.destroy',[$id])}}" method="POST">
    @csrf
	@method('DELETE')
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
</form>
{{-- {!! Form::open(['route' => ['companies.show', $id], 'method' => 'delete']) !!}
    {!! Form::button('Eliminar <i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
{!! Form::close() !!}
 --}}
{{--  {!! Form::open(['route' => ['objective.destroy',$id], 'method' => 'delete']) !!}
<div class='btn-group'>
     @can('eliminar_perspectiva')
         {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
     @endcan
</div>
 {!! Form::close() !!}
 --}}
