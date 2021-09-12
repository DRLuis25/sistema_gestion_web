<table class="table table-bordered table-striped table-hover ajaxTable datatable data-table" id="objectiveCompanies-table">
    <thead>
        <tr>
            <th>@lang('models/objectiveCompanies.fields.descripcion')</th>
            <th width="200px">@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('scripts')
    <script>
        $(function () {
            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('objectiveCompanies.index',[$company_id])}}",
                columns: [
                    { data: 'descripcion', name: 'descripcion'},
                    { data: 'action', name: 'Action', orderable: false, searchable: false},
                ],
                pageLength: 10,
            });
        })
    </script>
@endpush
