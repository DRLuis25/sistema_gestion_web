<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('models/historials.plural')</h1>
            </div>
        </div>
    </div>
</section>
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
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('historials.index')}}",
                columns: [
                    { "data":null, render:function(){return "";}},
                    { data: 'description', name: 'description'},
                    { data: 'created', name: 'created'},
                    { data: 'action', name: 'Action', orderable: false, searchable: false},
                ],
                pageLength: 10,
            });
        })
    </script>
@endpush
