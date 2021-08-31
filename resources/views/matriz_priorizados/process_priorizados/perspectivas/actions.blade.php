<form action="{{route('perspectives.destroy',[$id])}}" method="POST">
    @csrf
	@method('DELETE')
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
</form>