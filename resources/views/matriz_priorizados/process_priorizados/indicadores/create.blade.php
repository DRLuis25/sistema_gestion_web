<button type="button" class="btn btn-primary float-right"
    data-toggle="modal" data-target="#IndicadorModal"
    data-whatever="Registrar">
    @lang('crud.add_new')
</button>
<div class="modal fade" id="IndicadorModal" tabindex="-1" role="dialog" aria-labelledby="IndicadorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="IndicadorModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="createIndicador-form">
                {!! Form::hidden('matriz_priorizado_id', $matriz_priorizado_id) !!}
                {!! Form::hidden('process_id', $process_id) !!}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="descripcion" class="col-form-label">@lang('models/indicators.fields.name'):</label>
                        <input type="text" id="descripcion" name="descripcion" required class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="formula" class="col-form-label">@lang('models/indicators.fields.formula'):</label>
                        <input type="text" id="formula" name="formula" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="indicador_frequency_id" class="col-form-label">@lang('models/indicators.fields.frecuency_id'):</label>
                        <select name="frecuency_id" id="indicador_frequency_id" class="form-control" required>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="linea_base" class="col-form-label">@lang('models/indicators.fields.linea_base'):</label>
                        <input type="text" id="linea_base" name="linea_base" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="objetivo" class="col-form-label">@lang('models/indicators.fields.objetivo'):</label>
                        <input type="text" id="objetivo" name="objetivo" required class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="responsable" class="col-form-label">@lang('models/indicators.fields.responsable'):</label>
                        <input type="text" id="responsable" name="responsable" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="meta" class="col-form-label">@lang('models/indicators.fields.meta'):</label>
                            <input type="text" id="meta" name="meta" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="iniciativas" class="col-form-label">@lang('models/indicators.fields.iniciativas'):</label>
                        <textarea id="iniciativas" name="iniciativas" required class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="col-form-label">Semáforo:</label>
                    </div>
                </div>
                <div class="container my-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-1 align-self-center">
                            <i class="fa fa-circle fa-3x" style="color: red"></i>
                        </div>
                        <div class="col-1 align-self-center">
                            <h1 style="text-align: center;vertical-align: middle;"><</h1>
                        </div>
                        <div class="col-2 align-self-center">
                            <input type="number" class="form-control">
                        </div>
                        <div class="col-1 align-self-center">
                            <h1 style="text-align: center;vertical-align: middle;"><=</h1>
                        </div>
                        <div class="col-1 align-self-center">
                            <i class="fa fa-circle fa-3x" style="color: yellow"></i>
                        </div>
                        <div class="col-1 align-self-center">
                            <h1 style="text-align: center;vertical-align: middle;"><=</h1>
                        </div>
                        <div class="col-2 align-self-center">
                            <input type="number" class="form-control">
                        </div>
                        <div class="col-1 align-self-center">
                            <h1 style="text-align: center;vertical-align: middle;"><</h1>
                        </div>
                        <div class="col-1 align-self-center">
                            <i class="fa fa-circle fa-3x" style="color: green"></i>
                        </div>
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
        $('#IndicadorModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text('Registrar Indicador');
            $.get(`/api/frequencies`, function(res, sta){
                $("#indicador_frequency_id").empty();
                    $("#indicador_frequency_id").append(`<option value=''> -- Seleccione -- </option>`);
                res.forEach(element => {
                    $("#indicador_frequency_id").append(`<option value=${element.id}> ${element.descripcion} </option>`);
                });
            });
        });
        $('#createIndicador-form').on('submit', function(e){
            e.preventDefault();
            console.log($('#createIndicador-form').serialize());
            /*$.ajax({
                url: '/api/storeObjective', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createIndicador-form').serialize(),
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createIndicador-form').trigger('reset');
                        $('#IndicadorModal').modal('toggle');
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
            });*/
        });
    </script>

  @endpush
