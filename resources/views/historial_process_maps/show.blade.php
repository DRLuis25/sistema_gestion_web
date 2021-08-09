@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/historialProcessMaps.singular')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ url()->previous() }}">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('historial_process_maps.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts-process')
<script>
    var myDiagram;
$(function () {
    init();
});
function nodeInfo(d) {  // Tooltip info for a node data object
      var str = "Node " + d.key + ": " + d.text + "\n";
      if (d.group)
        str += "member of " + d.group;
      else
        str += "top-level node";
      return str;
    }
function init() {
        //Diagrama
        var $$ = go.GraphObject.make;
        if (myDiagram !== undefined) {
            myDiagram.div = null;
        }
        myDiagram = $$(go.Diagram, "showDiagramDiv",{
            "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
            "isReadOnly": true,
            layout: $$(go.TreeLayout, // specify a Diagram.layout that arranges trees
                { angle: 90, layerSpacing: 35 })
        });
        myDiagram.nodeTemplate =
        $$(go.Node, "Auto",
            { locationSpot: go.Spot.Center },
            $$(go.Shape, "RoundedRectangle",
            {
                fill: "white", // the default fill, if there is no data bound value
                portId: "", cursor: "pointer",  // the Shape is the port, not the whole Node
                // allow all kinds of links from and to this port
                fromLinkable: false, fromLinkableSelfNode: false, fromLinkableDuplicates: false,
                toLinkable: false, toLinkableSelfNode: false, toLinkableDuplicates: false
            },
            new go.Binding("fill", "color")),
            $$(go.TextBlock,
            {
                font: "bold 14px sans-serif",
                stroke: '#333',
                margin: 6,  // make some extra space for the shape around the text
                isMultiline: false,  // don't allow newlines in text
                editable: false  // allow in-place editing by user
            },
            new go.Binding("text", "text").makeTwoWay()),  // the label shows the node data's text
        );
        myDiagram.groupTemplate =
        $$(go.Group, "Vertical",
            {
                selectionObjectName: "PANEL",  // selection handle goes around shape, not label
                ungroupable: true  // enable Ctrl-Shift-G to ungroup a selected Group
            },
            $$(go.TextBlock,
            {
                //alignment: go.Spot.Right,
                font: "bold 19px sans-serif",
                isMultiline: false,  // don't allow newlines in text
                editable: false  // allow in-place editing by user
            },
            new go.Binding("text", "text").makeTwoWay(),
            new go.Binding("stroke", "color")),
            $$(go.Panel, "Auto",
            { name: "PANEL" },

            $$(go.Shape, "Rectangle",  // the rectangular shape around the members
                {
                fill: "rgba(128,128,128,0)", stroke: "gray", strokeWidth: 1,
                portId: "", cursor: "pointer",  // the Shape is the port, not the whole Node
                // allow all kinds of links from and to this port
                fromLinkable: false, fromLinkableSelfNode: false, fromLinkableDuplicates: false,
                toLinkable: false, toLinkableSelfNode: false, toLinkableDuplicates: false
                }),
            $$(go.Placeholder, { margin: 10, background: "transparent" })  // represents where the members are
            )
        );
        //Estructura datos
        myDiagram.model = go.Model.fromJson(document.getElementById("dataDiagram").value);
}
</script>
@endpush
