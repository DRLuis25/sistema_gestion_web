<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('models/objectives.plural')</h1>
            </div>
            {{-- @include('matriz_priorizados.process_priorizados.objetivos.edit') --}}
            @can('registrar_proceso')
                <div class="col-sm-6">
                    @include('matriz_priorizados.process_priorizados.objetivos.create')
                </div>
            @endcan
        </div>
    </div>
</section>
<table class="table table-bordered table-striped table-hover ajaxTable datatable data-table-objetivos" id="process-table">
    <thead>
        <tr>
            <th style="color:white">x</th>
            <th>@lang('models/objectives.fields.descripcion')</th>
            <th>@lang('models/objectives.fields.perspective_id')</th>
            <th width="100px">@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@push('scripts')
<script>
$(function () {
    //console.log('company_id: {{$company_id}}');
    //console.log('processMap_id: {{$process_map_id}}');
    let table = $('.data-table-objetivos').DataTable({
        "autoWidth": false,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        select:true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0,
            data: null,
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            'selectAll',
            'selectNone',
            'colvis',
            {

                extend: 'copyHtml5',
                title: '',
                text: 'Copiar',
                exportOptions: {
                    columns: function (idx, data, node) {
                        if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                            return false;
                        return true;
                    }
                }
            },
            {
                extend: 'excelHtml5',
                title: '',
                exportOptions: {
                    columns: function (idx, data, node) {
                        if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                            return false;
                        return true;
                    }
                }
            },
            {
                extend: 'csvHtml5',
                title: '',
                exportOptions: {
                    columns: function (idx, data, node) {
                        if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                            return false;
                        return true;
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                title: '',
                exportOptions: {
                    columns: function (idx, data, node) {
                        if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                            return false;
                        return true;
                    }
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                title: '',
                exportOptions: {
                    columns: ':visible'/*
                    columns: function (idx, data, node) {
                        if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                            return false;
                        return true;
                    }*/
                }
            },
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('objective.index',[$company_id,$process_map_id,$matriz_priorizado_id,$process_id])}}",
        columns: [
            { "data":null, render:function(){return "";}},
            { data: 'descripcion', name: 'descripcion'},
            { data: 'perpectiva', name: 'perpectiva'},
            { data: 'action', name: 'Action', orderable: false, searchable: false},
        ],
        orderCellsTop: true,
        order: [[ 1, 'asc' ]],
        pageLength: 10,
    });
});
</script>
@endpush
