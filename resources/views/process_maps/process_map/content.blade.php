<div class="tab-pane fade" id="mapaProceso" role="tabpanel" aria-labelledby="proceso-tab">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mapa de procesos</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="row justify-content-center">
        <div id="mapaProcesoDiv" style="border: solid 1px grey; width: 70%; height: 600px"></div>
    </div>
</div>
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
        myDiagram = $$(go.Diagram, "mapaProcesoDiv",{
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
        let nodeDataArray = [
                { key: -1, text: "Procesos Estratégicos", color: "black", isGroup: true },

                { key: -2, text: "Procesos Primarios", color: "black", isGroup: true },

                { key: -3, text: "Procesos de Apoyo", color: "black", isGroup: true },

            ];
        let linkDataArray = [];
        //Get data
        $.get(`/getProcessMap/{{$process_map_id}}`, function(res, sta){
            const data = res.process;
            data.forEach(c => {
                let colored = "white";
                switch (c.type) {
                    case 1:
                        colored= "lightblue";
                        break;
                    case 2:
                        colored= "lightgreen";
                        break;
                    case 3:
                        colored= "yellow";
                        break;
                    default:
                        colored= "red";
                        break;
                }
                nodeDataArray.push({
                    key:c.id,
                    text:c.name,
                    color: colored,
                    group:-1*c.type
                })
            });
            myDiagram.model = new go.GraphLinksModel(nodeDataArray,linkDataArray);
        });
}

</script>
@endpush
