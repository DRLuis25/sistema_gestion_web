<button type="button" class="btn btn-primary float-right"
    data-toggle="modal" data-target="#exampleModal"
    data-whatever="@mdo">
    @lang('crud.add_new')
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="createSupplyChainCustomer-form">
                {!! Form::hidden('supply_chain_id', $supplyChain->id) !!}
                <div class="row">
                    <div class="form-group col-6">
                        <label for="recipient-name" class="col-form-label">@lang('models/supplyChainCustomers.fields.customer_id'):</label>
                        <select name="customer_id" id="customer_id" class="form-control" required></select>
                    </div>
                    <div class="form-group col-6">
                        <label for="recipient-name" class="col-form-label">@lang('models/supplyChains.fields.level'):</label>
                        <input type="number" class="form-control" name="level" id="level" min="1" max="10" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="recipient-name" class="col-form-label">@lang('models/supplyChainCustomers.fields.parent_customer_id'):</label>
                        <select name="parent_customer_id" id="parent_customer_id" class="form-control">
                        </select>
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
@push('scripts-supplyChains')
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Registrar cliente CompID:{{$supplyChain->businessUnit->company_id}}' + recipient)
            //modal.find('.modal-body input').val(recipient)
            $.get(`/getCustomers/{{$supplyChain->businessUnit->company_id}}`, function(res, sta){
                console.log(res);
                console.log(sta);
                $("#customer_id").empty();
                $("#customer_id").append(`<option value=''> Seleccione cliente </option>`);
                res.forEach(element => {
                    $("#customer_id").append(`<option value=${element.id}> ${element.name} </option>`);
                });
            });
        });
        $("#level").change(event => {
            let nivel = $("#level").val();
            if(nivel==1){/*
                $.get(`/getCustomers/{{$supplyChain->businessUnit->company_id}}`, function(res, sta){
                    console.log(res);
                    console.log(sta);
                    $("#customer_id").empty();
                    $("#customer_id").append(`<option value=''> Seleccione cliente </option>`);
                    res.forEach(element => {
                        $("#customer_id").append(`<option value=${element.id}> ${element.name} </option>`);
                    });
                });*/
                $('#parent_customer_id').prop('required',false);
                $("#parent_customer_id").empty();
                $("#parent_customer_id").append(`<option value='0'> Esta Empresa </option>`);
            }
            else{
                nivel = nivel - 1;
                $.get(`/getSupplyChainCustomersParents/{{$supplyChain->id}}/${nivel}`, function(res, sta){
                $("#parent_customer_id").empty();
                $('#parent_customer_id').prop('required',true);
                $("#parent_customer_id").append(`<option value=''> Seleccione cliente </option>`);
                res.forEach(element => {
                    console.log(element.customer);
                    $("#parent_customer_id").append(`<option value=${element.customer.id}> ${element.customer.name} </option>`);
                });
                /*let selected = $('#customer_id').find(":selected").text()
                $("#customer_id option[value='option1']").remove();*/
            });
            }
        });
        $('#createSupplyChainCustomer-form').on('submit', function(e){
            e.preventDefault();
            console.log($('#createSupplyChainCustomer-form').serialize());
            $.ajax({
                url: '{{route('supplyChainCustomers.store')}}', //this is the submit URL
                type: 'POST', //or POST
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $('#createSupplyChainCustomer-form').serialize(),
                success: function(data){
                    if(data.status==200){
                        console.log(data);
                        alert('Registrado correctamente');
                        $('#createSupplyChainCustomer-form').trigger('reset');
                        $('#exampleModal').modal('toggle');
                        $('#supplyChainCustomers-table').DataTable().ajax.reload();
                        replaceDiagram();
                    }
                    else if (data.status==500) {
                        alert("Error al registrar. Registro duplicado");
                    }

                },
            });
        });
    </script>

  @endpush
