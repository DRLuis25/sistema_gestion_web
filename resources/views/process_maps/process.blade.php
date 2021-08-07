<div class="tab-pane fade" id="proceso" role="tabpanel" aria-labelledby="proceso-tab">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/process.plural')</h1>
                </div>
                @can('registrar_proceso')
                    <div class="col-sm-6">
                        @include('process_maps.process.create')
                    </div>
                @endcan
            </div>
        </div>
    </section>
    <table class="table table-bordered table-striped table-hover ajaxTable datatable data-table-process" id="process-table">
        <thead>
            <tr>
                <th style="color:white">x</th>
                <th>@lang('models/process.fields.name')</th>
                <th>@lang('models/process.fields.description')</th>
                <th width="100px">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@push('scripts-process')
<script>

</script>
@endpush
