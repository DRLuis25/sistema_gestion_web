<!-- Business Unit Id Field -->
<div class="col-sm-2">
    {!! Form::label('supply_chain_id', __('models/businessUnits.fields.name').':') !!}
    <p>{{ $historial->supplyChain->businessUnit->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-4">
    {!! Form::label('created_at', __('models/historials.fields.created_at').':') !!}
    <p>{{ $historial->created_at->format("d-m-Y H:i:s") }}</p>
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
            "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
            "undoManager.isEnabled": true,//enable Ctrl z
            "isReadOnly": true,
            "layout": new go.LayeredDigraphLayout()
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
        /*myDiagram.linkTemplate =
        $$(go.Link,  // the whole link panel
        {
            curve: go.Link.Bezier,
            adjusting: go.Link.Stretch,
            reshapable: true,
            relinkableFrom: false,
            relinkableTo: false,
            toShortLength: 3
        },
        new go.Binding("points").makeTwoWay(),
        new go.Binding("curviness"),
        $$(go.Shape,  // the link shape
            { strokeWidth: 2, stroke: "#555" }),
        $$(go.Shape,  // the arrowhead
            { toArrow: "standard", stroke: "#555", scale: 1.5 })
        );*/
        myDiagram.model = go.Model.fromJson(document.getElementById("dataDiagram").value);
    }
</script>
@endpush
