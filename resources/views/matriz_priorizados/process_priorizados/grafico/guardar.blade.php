<div class="modal fade" id="historial-grafico-tab" tabindex="-1" role="dialog" aria-labelledby="historial-grafico-tab" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guardar en Historial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="createHistorial-form">
                    {!! Form::hidden('process_id', $process_id) !!}
                    {!! Form::hidden('matriz_priorizado_id', $matriz_priorizado_id) !!}
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" name="description" id="description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts-historial')
    <script>
        $('#historial-grafico-tab').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-title').text('Guardar mapa estratégico')
        });
        $('#createHistorial-form').on('submit', function(e){
            e.preventDefault();
            var dataDiagram = myDiagram.model.toJson();
            //JSON.stringify()
            console.log($('#createHistorial-form').serialize() + `&data=${dataDiagram}`);
            $.ajax({
                url: '{{route('api.storeStrategicMap')}}', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createHistorial-form').serialize() + `&data=${dataDiagram}`,
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createHistorial-form').trigger('reset');
                        $('#historial-grafico-tab').modal('toggle');
                        $('#historials-table').DataTable().ajax.reload();
                    }
                    else if (data.status==500) {
                        alert("Error al registrar. Registro duplicado");
                        console.log(data.message);
                    }

                },
            });
        });
    </script>
@endpush
