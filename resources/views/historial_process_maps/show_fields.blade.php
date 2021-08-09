<!-- Process Map Id Field -->
<div class="col-sm-12">
    {!! Form::label('supply_chain_id', __('models/businessUnits.fields.name').':') !!}
    <p>{{ $historialProcessMap->processMap->businessUnit->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/historialProcessMaps.fields.description').':') !!}
    <p>{{ $historialProcessMap->description }}</p>
</div>
<!-- Data Field -->
<div class="col-sm-12">
    <textarea name="dataDiagram" id="dataDiagram" hidden>{{$historialProcessMap->data}}</textarea>
    <div id="showDiagramDiv"style="border: solid 1px grey; width: 70%; height: 600px"></div>
    {{-- <div id="showDiagramDiv"style="width:800px; height:600px; background-color: #DAE4E4;"></div> --}}
</div>
