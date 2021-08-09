
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="updateFile-form">
                {!! Form::hidden('process_map_id', $process_map_id) !!}
                <input type="hidden" name="process_id" id="process_id">
                <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile" name="fileUpdate" required aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile">Buscar archivo</label>
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
        $('#uploadModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var modal = $(this);
            $('#process_id').val(recipient);
            modal.find('.modal-title').text(recipient + ' process_map_id:{{$process_map_id}}')
        });
        $('#updateFile-form').on('submit', function(e){
            e.preventDefault();
            console.log($('#updateFile-form').serialize());
            var fd = new FormData();
            var files = $('#inputGroupFile')[0].files;
            // Check file selected or not
            if(files.length > 0 ){
                fd.append('fileUpdate',files[0]);
                fd.append('process_id',$('#process_id').val());
                fd.append('process_map_id',{{$process_map_id}});
                //alert('si');
                //return false;
                $.ajax({
                    url: '{{route('storeProcessFlowDiagramRedesignFile')}}', //this is the submit URL
                    type: 'POST', //or POST
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        if(data.status==200){
                            console.log(data);
                            alert('Registrado correctamente');
                            $('#updateFile-form').trigger('reset');
                            $('#uploadModal').modal('toggle');
                            $('.data-table').DataTable().ajax.reload();
                            console.log("reload");
                            //replaceDiagram(); Update Mapa proceso
                        }
                        else if (data.status==500) {
                            console.log(data.e);
                            alert("Error al registrar. Registro duplicado");
                        }

                    },
                });
            }
        });
    </script>

  @endpush
