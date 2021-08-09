<div class="modal fade" id="editProcessModal" tabindex="-1" role="dialog" aria-labelledby="editProcessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProcessModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="editProcess-form">
                <input type="text" hidden id="id-edit" name="id">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name" class="col-form-label">@lang('models/processes.fields.name'):</label>
                        <input type="text" id="name-edit" name="name" required class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label for="description" class="col-form-label">@lang('models/processes.fields.description'):</label>
                        <input type="text" class="form-control" name="description" id="description-edit" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="type" class="col-form-label">@lang('models/processMaps.fields.type'):</label> <br>
                        <input type="text" class="form-control" id="types" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Actualizar" class="btn btn-primary">
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@push('scripts-process')
    <script>
        $('#editProcessModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text('Editar proceso ProcessId:' + recipient)
            $.get(`/getProcessById/` + recipient, function(res, sta){
                console.log(res);
                console.log(sta);
                $('#id-edit').val(res.process.id);
                $('#name-edit').val(res.process.name);
                $('#description-edit').val(res.process.description);
                $('#types').val(res.types);
            });
        });
        $('#editProcess-form').on('submit', function(e){
            e.preventDefault();
            var a = $('#id-edit').val();
            console.log(a);
            console.log($('#editProcess-form').serialize());
            $.ajax({
                url: `/process/${a}`, //this is the submit URL
                type: 'PUT', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#editProcess-form').serialize(),
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Actualizado correctamente');
                        $('#editProcess-form').trigger('reset');
                        $('#editProcessModal').modal('toggle');
                        $('#process-table').DataTable().ajax.reload();
                        //replaceDiagram(); Update Mapa proceso
                    }
                    else if (data.status==500) {
                        console.log(data.e);
                        alert("Error al registrar. "+data.e);
                    }

                },
            });
        });
    </script>

  @endpush
