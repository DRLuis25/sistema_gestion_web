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
                        <label for="" class="col-form-label">@lang('models/objectives.fields.descripcion'):</label>
                        <input type="checkbox" id="objetivo_empresa_check">
                        <input type="hidden" name="nuevo" id="objetivo_empresa" value="1">
                        <label for="objetivo_empresa">Empresa</label>
                        <input type="text" id="descripcion_objetivo" name="descripcion" required class="form-control">
                        <select name="objetivo_company" id="objetivo_company" hidden class="form-control">
                            <option value="">--Seleccione uno--</option>
                            @foreach ($objetivos_empresa as $item)
                            <option value="{{$item->id}}">{{$item->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="perspective_id" class="col-form-label">@lang('models/objectives.fields.perspective_id'):</label>
                        <select name="perspective_id" id="perspective_id" class="form-control" required>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="description" class="col-form-label">@lang('models/objectives.fields.effect_id'):</label>
                        <input type="checkbox" name="efecto_perpectiva" id="efecto_perpectiva">
                        <label for="efecto_perpectiva">En perspectiva</label>
                        <select name="effect_id[]" id="effect_id" class="form-control" multiple {{-- required --}}>
                            {{-- Dinámico --}}
                        </select>
                        <input type="hidden" name="efecto_en_perspectiva" id="efecto_en_perspectiva" value="0">
                        <select name="effect_perspective_id[]" id="effect_perspective_id" class="form-control" multiple hidden>
                            {{-- Dinámico perspectivas --}}
                            <option value="">Perspectiva del proceso 1</option>
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
        $('#objetivo_empresa_check').change((evt)=>{
            IsChecked = $('#objetivo_empresa_check')[0].checked;
            $('#descripcion_objetivo').attr('hidden',IsChecked);
            $('#objetivo_company').attr('hidden',!IsChecked);
            $('#descripcion_objetivo').attr('required',!IsChecked);
            $('#objetivo_company').attr('required',IsChecked);
            if (IsChecked) {
                $('#objetivo_empresa').val('0');
            }
            else{
                $('#objetivo_empresa').val('1');
            }
        });
        $('#efecto_perpectiva').change((evt)=>{
            IsChecked = $('#efecto_perpectiva')[0].checked;
            $('#effect_id').attr('hidden',IsChecked);
            $('#effect_perspective_id').attr('hidden',!IsChecked);
            console.log(IsChecked);
            if (IsChecked) {
                $('#efecto_en_perspectiva').val('1');
            }
            else{
                $('#efecto_en_perspectiva').val('0');
            }
        });
        $('#objetivoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            $.get(`/api/getPerspectivas/{{$process_id}}`, function(res, sta){
                $("#perspective_id").empty();
                $("#perspective_id").append(`<option value="">--Seleccione uno--</option>`);
                res.forEach(element => {
                    $("#perspective_id").append(`<option value="${element.id}" data-orden="${element.orden}">${element.perspective_company.descripcion}</option>`);
                });
                //$('#perspective_id').selectize();
            });
            modal.find('.modal-title').text(recipient + ' objetivo');
        });
        $("#perspective_id").change(event => {
            let orden = $("#perspective_id").find(':selected').data('orden');
            //En objetivo
            $.get(`/api/getObjectives/{{$matriz_priorizado_id}}/{{$process_id}}/${orden}`, function(res, sta){
                $("#effect_id").empty();
                res.forEach(element => {
                    $("#effect_id").append(`<option value=${element.id}> ${element.descripcion} </option>`);
                });
            });
            //En perspectiva
            $.get(`/api/getPerspectivasOrden/{{$process_id}}/${orden}`, function(res, sta){
                $("#effect_perspective_id").empty();

                res.forEach(element => {
                    $("#effect_perspective_id").append(`<option value="${element.id}" data-orden="${element.orden}">${element.perspective_company.descripcion}</option>`);
                });
                //$('#perspective_id').selectize();
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
