<button type="button" class="btn btn-primary float-right"
    data-toggle="modal" data-target="#perspectivaModal"
    data-whatever="Registrar">
    @lang('crud.add_new')
</button>
<div class="modal fade" id="perspectivaModal" tabindex="-1" role="dialog" aria-labelledby="perspectivaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="perspectivaModalLabel">New Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="createPerspective-form">
                {!! Form::hidden('matriz_priorizado_id', $matriz_priorizado_id) !!}
                {!! Form::hidden('process_id', $process_id) !!}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="descripcion" class="col-form-label">@lang('models/perspectives.fields.descripcion'):</label>
                        <input type="text" id="descripcion" name="descripcion" required class="form-control">
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
@push('scripts')
    <script>
        $(document).ready(function() {
            //$('#effect_id').selectize();
        });
        $('#perspectivaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text(recipient + ' Perspectiva ')
        });
        $('#createPerspective-form').on('submit', function(e){
            e.preventDefault();
            console.log($('#createPerspective-form').serialize());
            $.ajax({
                url: '/api/store', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createPerspective-form').serialize(),
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createPerspective-form').trigger('reset');
                        $('#perspectivaModal').modal('toggle');
                        $('.data-table-perspective').DataTable().ajax.reload();
                        console.log("reload");
                        console.log(data.e);
                        $("#effect_id").empty();
                        //Recargar gráfico init();
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
