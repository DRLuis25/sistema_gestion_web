<table class="table table-bordered table-striped table-hover ajaxTable datatable data-table" id="historials-table">
    <thead>
        <tr>
            <th style="color:white">x</th>
            <th>@lang('models/historials.fields.description')</th>
            <th>@lang('models/historials.fields.created_at')</th>
            <th width="100px">@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    <script>
        $(function () {
            let table = $('.data-table').DataTable({
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                languages:{
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
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
                ajax: "{{ route('historials.index')}}",
                columns: [
                    { "data":null, render:function(){return "";}},
                    { data: 'description', name: 'description'},
                    { data: 'created', name: 'created'},
                    { data: 'action', name: 'Action', orderable: false, searchable: false},
                ],
                orderCellsTop: true,
                order: [[ 2, 'asc' ]],
                pageLength: 10,
            });
        })
    </script>
@endpush
