<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="activityModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
            <form method="POST" id="createActivity-form">
                {{-- {!! Form::hidden('process_map_id', null) !!} --}}
                <div class="row">
                    <div class="form-group col-8">
                        <label for="activity" class="col-form-label">@lang('models/seguimientos.fields.activity'):</label>
                        <input type="text" id="activity" name="activity" required class="form-control">
                    </div>
                    <div class="form-group col-4">
                        <label for="time" class="col-form-label">@lang('models/seguimientos.fields.time') ({{$process->unidad}}):</label>
                        <input type="number" class="form-control" name="time" id="time" step='1' min="00:00:00" max="20:00:00" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="rol_id" class="col-form-label">@lang('models/seguimientos.fields.rol_id'):</label>
                        <select name="rol_id" id="rol_id" class="form-control" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="flow_id" class="col-form-label">@lang('models/seguimientos.fields.flow_id'):</label>
                        <select name="flow_id" id="flow_id" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            <option value="1">Operación</option>
                            <option value="2">Transporte</option>
                            <option value="3">Inspección</option>
                            <option value="4">Demora</option>
                            <option value="5">Almacenaje</option>
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
        $(function () {
            calcularTotales();
        });
        $('#processModal').on('show.bs.modal', function (event) {

            /*if (process_id==="") {
                alert("Debes seleccionar un proceso.");
                return false;
            }
            console.log(process_id);*/
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text(recipient + ' proceso Process_id:AGREGAR')
        });
        $('#createActivity-form').on('submit', function(e){
            e.preventDefault();
            console.log($('#createActivity-form').serialize()+'&process_map_id={{$process_map_id}}&process_id={{$process_id}}');
            //let process_id = '1';//$('#select_proceso_id').val();
            $.ajax({
                url: '{{route('storeActivity')}}', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createActivity-form').serialize()+'&process_map_id={{$process_map_id}}&process_id={{$process_id}}',
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createActivity-form').trigger('reset');
                        $('#activityModal').modal('toggle');
                        $('#seguimientos-table').DataTable().ajax.reload();
                        //Calcular tiempos
                        console.log("calcular tiempos");
                        calcularTotales();
                    }
                    else if (data.status==500) {
                        console.log(data.e);
                        alert("Error al registrar. Registro duplicado");
                    }

                },
            });
        });
        function calcularTotales() {
            $("#rolTimesTable > tbody").empty();
            $("#flowTimesTable > tbody").empty();
            $.get(`/getTimes/{{$process_id}}`, function(res, sta){
            const rolTimes = res.rolTimes;
            const flowTimes = res.flowTimes;
            console.log(rolTimes)
            rolTimes.forEach(c => {
                let markup = "<tr class='text-center'><td>"+c.name+"</td><td>"
                + c.total + "</td>";
                $("#rolTimesTable > tbody").append(markup);
            });
            flowTimes.forEach(c => {
                let op = "white";
                switch (c.flow_id) {
                    case 1:
                        op = "Operación";
                        break;
                    case 2:
                        op = "Transporte";
                        break;
                    case 3:
                        op = "Inspección";
                        break;
                    case 4:
                        op = "Demora";
                        break;
                    default:
                        op = "Almacenaje";
                        break;
                }
                let markup = "<tr class='text-center'><td><img src='/img/"+c.flow_id+".png' alt='"+op+"'>"+op+"</td><td>"
                + c.total + "</td>";
                $("#flowTimesTable > tbody").append(markup);
            });
        });
        }
    </script>

  @endpush
