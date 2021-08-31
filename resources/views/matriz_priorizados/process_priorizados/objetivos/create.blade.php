<button type="button" class="btn btn-primary float-right"
    data-toggle="modal" data-target="#objetivoModal"
    data-whatever="Registrar">
    @lang('crud.add_new')
</button>
<div class="modal fade" id="objetivoModal" tabindex="-1" role="dialog" aria-labelledby="objetivoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="objetivoModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="createObjective-form">
                {!! Form::hidden('matriz_priorizado_id', $matriz_priorizado_id) !!}
                {!! Form::hidden('process_id', $process_id) !!}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="descripcion" class="col-form-label">@lang('models/objectives.fields.descripcion'):</label>
                        <input type="text" id="descripcion" name="descripcion" required class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="perspective_id" class="col-form-label">@lang('models/objectives.fields.perspective_id'):</label>
                        <select name="perspective_id" id="perspective_id" class="form-control" required>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="description" class="col-form-label">@lang('models/objectives.fields.effect_id'):</label>
                        <select name="effect_id[]" id="effect_id" class="form-control" multiple>
                            {{-- Dinámico --}}
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
@push('scripts')
    <script>
        $(document).ready(function() {

            //$('#effect_id').selectize();
        });
        $('#objetivoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            $.get(`/api/getPerspectivas/{{$process_id}}`, function(res, sta){
                console.log(res);
                console.log(sta);
                $("#perspective_id").empty();
                $("#perspective_id").append(`<option value=""></option>`);
                res.forEach(element => {
                    $("#perspective_id").append(`<option value="${element.id}" data-orden="${element.orden}">${element.descripcion}</option>`);
                });
                //$('#perspective_id').selectize();
            });
            modal.find('.modal-title').text(recipient + ' objetivo matriz_priorizados_id:{{$matriz_priorizado_id}}')
        });
        $("#perspective_id").change(event => {
            let orden = $("#perspective_id").val();
            orden = $("#perspective_id").find(':selected').data('orden');
            console.log('orden:',orden);
            $.get(`/api/getObjectives/{{$matriz_priorizado_id}}/{{$process_id}}/${orden}`, function(res, sta){
                $("#effect_id").empty();
                //$('#effect_id').prop('required',true);
                //$("#effect_id").append(`<option value=''> </option>`);
                res.forEach(element => {
                    console.log(element.customer);
                    $("#effect_id").append(`<option value=${element.id}> ${element.descripcion} </option>`);
                });
            });
        });
        $('#createObjective-form').on('submit', function(e){
            e.preventDefault();
            console.log($('#createObjective-form').serialize());
            $.ajax({
                url: '/api/storeObjective', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createObjective-form').serialize(),
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createObjective-form').trigger('reset');
                        $('#objetivoModal').modal('toggle');
                        $('.data-table-objetivos').DataTable().ajax.reload();
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
