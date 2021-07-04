<!-- Business Unit Id Field -->
<div class="col-sm-2">
    {!! Form::label('supply_chain_id', __('models/businessUnits.fields.name').':') !!}
    <p>{{ $historial->supplyChain->businessUnit->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-4">
    {!! Form::label('created_at', __('models/historials.fields.created_at').':') !!}
    <p>{{ $historial->created_at->format("d/m/Y") }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/historials.fields.description').':') !!}
    <p>{{ $historial->description }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    <p hidden>{{ $historial->data }}</p>
    <textarea name="dataDiagram" id="dataDiagram" hidden>{{$historial->data}}</textarea>
    <div id="showDiagramDiv"style="width:800px; height:600px; background-color: #DAE4E4;"></div>
</div>

@push('scripts')
<script>
    $(function () {
        init();
    });
    function init() {
        //Diagrama
        var $$ = go.GraphObject.make;
        myDiagram = $$(go.Diagram, "showDiagramDiv",{
            initialContentAlignment: go.Spot.Center,
            "undoManager.isEnabled": true,//enable Ctrl z
            "isReadOnly": true,
        });
        myDiagram.nodeTemplate =$$(go.Node,
            "Auto",
            $$(go.Shape,
            {
                figure: "RoundedRectangle",
                fill: "lightblue"
            }
            ),
            $$(go.TextBlock,
            {
                margin: 5
            },
            new go.Binding("text", "name")
            )
        );
        myDiagram.layout = new go.TreeLayout();
        myDiagram.linkTemplate =$$(go.Link,
            new go.Binding("routing", "routing"),
            $$(go.Shape),
            $$(go.Shape, { toArrow: "Standard" })
        );
        myDiagram.model = go.Model.fromJson(document.getElementById("dataDiagram").value);
    }
</script>
@endpush
