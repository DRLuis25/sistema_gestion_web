<button type="button" class="btn btn-primary float-right"
    data-toggle="modal" data-target="#dataFuenteModal"
    data-whatever="Data Fuente">
    Data fuente
</button>
<div class="modal fade" id="dataFuenteModal" tabindex="-1" role="dialog" aria-labelledby="dataFuenteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dataFuenteModalLabel">Gráfico tendencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    {{-- Registrar data fuente --}}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@push('scripts')
<script>
    $('#dataFuenteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text(recipient);
    });
</script>
@endpush
