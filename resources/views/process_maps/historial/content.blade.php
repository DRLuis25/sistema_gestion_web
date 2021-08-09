<div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="proceso-tab">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/historials.plural')</h1>
                </div>
            </div>
        </div>
    </section>
    <table class="table table-bordered table-striped table-hover ajaxTable datatable data-table3" id="historials-table">
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
</div>
@push('scripts')
<script>
    $(function () {
        console.log('{{$process_map_id}}');
        let table3 = $('.data-table3').DataTable({
            "autoWidth": false,
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0,
                    data: null,
                }],
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
                processing: true,
                serverSide: true,
                //ajax: "{{ route('historials.index')}}",
                ajax: "{{ route('getHistorialProcessMaps',[$process_map_id])}}",
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
        init();
    });
</script>
@endpush
