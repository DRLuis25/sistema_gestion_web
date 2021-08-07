<table class="table table-bordered table-striped table-hover ajaxTable datatable seguimientos-data-table" id="seguimientos-table">
    <thead>
        <tr>
            <th style="color:white">x</th>
            <th>@lang('models/seguimientos.fields.activity')</th>
            <th>@lang('models/seguimientos.fields.rol_id')</th>
            <th>@lang('models/seguimientos.fields.flow_id')</th>
            <th>@lang('models/seguimientos.fields.time')</th>
            <th width="100px">@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Resumen</h3>
        </div>
    </div>
</div>
<div class="row justify-content-around">
    <table class="table col-4" id="rolTimesTable">
     <thead>
       <tr>
         <th scope="col">Rol</th>
         <th scope="col">Tiempo (minutos)</th>
       </tr>
     </thead>
     <tbody>
       <tr >
         <td>Rol #1</td>
         <td>## min</td>
       </tr>
     </tbody>
   </table>

   <table class="table col-4" id="flowTimesTable">
     <thead>
       <tr>
         <th scope="col">Actividad</th>
         <th scope="col">Tiempo (minutos)</th>
       </tr>
     </thead>
     <tbody>
        <tr >
         <td>Rol #1</td>
         <td>## min</td>
       </tr>
     </tbody>
   </table>
 </div>
@push('scripts')
    <script>
        $(function () {
            let table = $('.seguimientos-data-table').DataTable({
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

                processing: true,
                serverSide: true,
                ajax: "{{ route('seguimientos.show',[$company_id, $process_map_id,$process_id])}}",
                columns: [
                    { "data":null, render:function(){return "";}},
                    { data: 'activity', name: 'activity'},
                    { data: 'rolname', name: 'rolname'},
                    { data: 'flujoname', name: 'flujoname'},
                    { data: 'time', name: 'time'},
                    { data: 'action', name: 'Action', orderable: false, searchable: false},
                ],
                orderCellsTop: true,
                pageLength: 10,
            });
        })
    </script>
@endpush
