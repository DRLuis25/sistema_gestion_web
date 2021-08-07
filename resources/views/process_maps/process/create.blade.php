<button type="button" class="btn btn-primary float-right"
    data-toggle="modal" data-target="#processModal"
    data-whatever="Registrar">
    @lang('crud.add_new')
</button>
<div class="modal fade" id="processModal" tabindex="-1" role="dialog" aria-labelledby="processModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="processModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="createProcess-form">
                {!! Form::hidden('process_map_id', $processMap->id) !!}
                {!! Form::hidden('status', '0') !!}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name" class="col-form-label">@lang('models/processes.fields.name'):</label>
                        <input type="text" id="name" name="name" required class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label for="description" class="col-form-label">@lang('models/processes.fields.description'):</label>
                        <input type="text" class="form-control" name="description" id="description" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="type" class="col-form-label">@lang('models/processMaps.fields.type'):</label> <br>
                        <input type="checkbox" name="type[]" id="type1" value="1"> <label for="type1">Proceso Estratégico</label>
                        <input type="checkbox" name="type[]" id="type2" value="2"> <label for="type2">Proceso Primario</label>
                        <input type="checkbox" name="type[]" id="type3" value="3"> <label for="type3">Proceso Apoyo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="parent_process_id" class="col-form-label">@lang('models/processes.fields.parent_process_id'):</label>
                        <select name="parent_process_id" id="parent_process_id" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Guardar" class="btn btn-primary" id="checkBtn">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@push('scripts-process')
    <script>
        $('#processModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text(recipient + ' proceso processMapId:{{$processMap->id}}')
        });
        $('#createProcess-form').on('submit', function(e){
            e.preventDefault();
            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("Debes marcar al menos un tipo de proceso.");
                return false;
            }
            console.log($('#createProcess-form').serialize());
            $.ajax({
                url: '{{route('process.store')}}', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createProcess-form').serialize(),
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createProcess-form').trigger('reset');
                        $('#processModal').modal('toggle');
                        $('.data-table-process').DataTable().ajax.reload();
                        console.log("reload");
                        init();
                        //replaceDiagram(); Update Mapa proceso
                    }
                    else if (data.status==500) {
                        console.log(data.e);
                        alert("Error al registrar. Registro duplicado");
                    }

                },
            });
        });
    </script>

  @endpush
