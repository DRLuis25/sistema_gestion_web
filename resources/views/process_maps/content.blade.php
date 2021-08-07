
<div class="tab-pane fade" id="suppliers" role="tabpanel" aria-labelledby="suppliers-tab">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/supplyChainSuppliers.plural')</h1>
                </div>
                @can('registrar_proveedor_cadena_suministro')
                    <div class="col-sm-6">
                        @include('supply_chains.suppliers.create')
                    </div>
                @endcan
            </div>
        </div>
    </section>
    <table class="table table-bordered table-striped table-hover ajaxTable datatable data-table" id="supplyChainSuppliers-table">
        <thead>
            <tr>
                <th style="color:white">y</th>
                <th>@lang('models/supplyChainSuppliers.fields.supplier_id')</th>
                <th>@lang('models/supplyChainSuppliers.fields.parent_supplier_id')</th>
                <th>@lang('models/supplyChainSuppliers.fields.level_id')</th>
                <th width="100px">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="tab-pane fade" id="graphic" role="tabpanel" aria-labelledby="suppliers-tab">
    <div class="container-fluid">
        <div class="row m-2">
            <div class="col-sm-12">
                @can('crear_historial_cadena_suministro')
                    <button type="button" class="btn btn-primary float-right m-2"
                    data-toggle="modal" data-target="#historial-tab"
                    data-whatever="@mdo">
                    Guardar en Historial
                    </button>
                @endcan
                @can('exportar_grafico_cadena_suministro')
                    <button onclick="exportImg()" class="btn btn-primary float-right m-2">Exportar Img</button>
                    <button onclick="exportPdf()" class="btn btn-primary float-right m-2">Exportar PDF</button>
                @endcan
                @include('supply_chains.historial')
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div id="myDiagramDiv"style="width:800px; height:600px; background-color: #DAE4E4;"></div>
    </div>
</div>
<div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="suppliers-tab">
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
