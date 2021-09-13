<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('models/indicators.plural')</h1>
            </div>
            {{-- @include('matriz_priorizados.process_priorizados.objetivos.edit') --}}
            @can('registrar_proceso')
                <div class="col-sm-6">
                    @include('matriz_priorizados.process_priorizados.indicadores.create')
                </div>
            @endcan
        </div>
    </div>
</section>
<table class="table table-bordered table-striped table-hover ajaxTable datatable data-table-indicadores" id="indicadores-table">
    <thead>
        <tr>
            <th style="color:white">x</th>
            <th>@lang('models/indicators.fields.descripcion')</th>
            <th>@lang('models/indicators.fields.responsable')</th>
            <th width="100px">@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@push('scripts')
<script>
$(function () {
    let table = $('.data-table-indicadores').DataTable({
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "{{ route('indicators.index',[$company_id,$process_map_id,$matriz_priorizado_id,$process_id])}}",
        columns: [
            { "data":null, render:function(){return "";}},
            { data: 'descripcion', name: 'descripcion'},
            { data: 'perpectiva', name: 'perpectiva'},
            { data: 'action', name: 'Action', orderable: false, searchable: false},
        ],
        pageLength: 10,
    });
});
</script>
@endpush
