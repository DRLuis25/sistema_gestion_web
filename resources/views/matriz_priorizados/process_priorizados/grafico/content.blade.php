<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mapa estratégico</h1>
            </div>
            <div class="col-sm-12">
                @can('exportar_grafico_mapa_estrategico')
                    <button type="button" class="btn btn-primary float-right m-2"
                    data-toggle="modal" data-target="#historial-tab"
                    data-whatever="@mdo">
                    Guardar en Historial
                    </button>
                @endcan
                @can('exportar_grafico_mapa_estrategico')
                    <button {{-- onclick="exportImg()" --}} class="btn btn-primary float-right m-2">Exportar Img</button>
                    <button {{-- onclick="exportPdf()" --}} class="btn btn-primary float-right m-2">Exportar PDF</button>
                @endcan
                {{-- @include('process_maps.historial.historial') --}}
            </div>
        </div>
    </div>
</section>
<div class="row justify-content-center">
    <div id="mapaEstrategicoDiv" style="border: solid 1px grey; width: 70%; height: 600px"></div>
</div>

@push('scripts')
<script>
    var myDiagram;
    $(function () {
        init();
    });
    function PoolLayout() {
      go.GridLayout.call(this);
      this.cellSize = new go.Size(1, 1);
      this.wrappingColumn = 1;
      this.wrappingWidth = Infinity;
      this.isRealtime = false;  // don't continuously layout while dragging
      this.alignment = go.GridLayout.Position;
      // This sorts based on the location of each Group.
      // This is useful when Groups can be moved up and down in order to change their order.
      this.comparer = function(a, b) {
        var ay = a.location.y;
        var by = b.location.y;
        if (isNaN(ay) || isNaN(by)) return 0;
        if (ay < by) return -1;
        if (ay > by) return 1;
        return 0;
      };
    }
    go.Diagram.inherit(PoolLayout, go.GridLayout);

    PoolLayout.prototype.doLayout = function(coll) {
      var diagram = this.diagram;
      if (diagram === null) return;
      diagram.startTransaction("PoolLayout");
      var pool = this.group;
      if (pool !== null && pool.category === "Pool") {
        // make sure all of the Group Shapes are big enough
        var minsize = computeMinPoolSize(pool);
        pool.memberParts.each(function(lane) {
          if (!(lane instanceof go.Group)) return;
          if (lane.category !== "Pool") {
            var shape = lane.resizeObject;
            if (shape !== null) {  // change the desiredSize to be big enough in both directions
              var sz = computeLaneSize(lane);
              shape.width = (isNaN(shape.width) ? minsize.width : Math.max(shape.width, minsize.width));
              shape.height = (!isNaN(shape.height)) ? Math.max(shape.height, sz.height) : sz.height;
              var cell = lane.resizeCellSize;
              if (!isNaN(shape.width) && !isNaN(cell.width) && cell.width > 0) shape.width = Math.ceil(shape.width / cell.width) * cell.width;
              if (!isNaN(shape.height) && !isNaN(cell.height) && cell.height > 0) shape.height = Math.ceil(shape.height / cell.height) * cell.height;
            }
          }
        });
      }
      // now do all of the usual stuff, according to whatever properties have been set on this GridLayout
      go.GridLayout.prototype.doLayout.call(this, coll);
      diagram.commitTransaction("PoolLayout");
    };
    function stayInGroup(part, pt, gridpt) {
        // don't constrain top-level nodes
        var grp = part.containingGroup;
        if (grp === null) return pt;
        // try to stay within the background Shape of the Group
        var back = grp.resizeObject;
        if (back === null) return pt;
        // allow dragging a Node out of a Group if the Shift key is down
        if (part.diagram.lastInput.shift) return pt;
        var p1 = back.getDocumentPoint(go.Spot.TopLeft);
        var p2 = back.getDocumentPoint(go.Spot.BottomRight);
        var b = part.actualBounds;
        var loc = part.location;
        // find the padding inside the group's placeholder that is around the member parts
        var m = grp.placeholder.padding;
        // now limit the location appropriately
        var x = Math.max(p1.x + m.left, Math.min(pt.x, p2.x - m.right - b.width - 1)) + (loc.x - b.x);
        var y = Math.max(p1.y + m.top, Math.min(pt.y, p2.y - m.bottom - b.height - 1)) + (loc.y - b.y);
        return new go.Point(x, y);
      }
    function init() {
        //Diagrama
        var $$ = go.GraphObject.make;
        myDiagram = $$(go.Diagram, "mapaEstrategicoDiv",{
            initialContentAlignment: go.Spot.Center,
            "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
            "undoManager.isEnabled": true,//enable Ctrl z
            "isReadOnly": true,
            "layout": $$(PoolLayout),
        });
        myDiagram.nodeTemplate =
        $$(go.Node, "Auto",
          new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
          $$(go.Shape, "Rectangle",
            { fill: "white", portId: "", cursor: "pointer", fromLinkable: true, toLinkable: true }),
          $$(go.TextBlock, { margin: 5 },
            new go.Binding("text", "text")),
          { dragComputation: stayInGroup } // limit dragging of Nodes to stay within the containing Group, defined above
        )
        //***************************************************
        function groupStyle() {  // common settings for both Lane and Pool Groups
        return [
          {
            layerName: "Background",  // all pools and lanes are always behind all nodes and links
            background: "transparent",  // can grab anywhere in bounds
            movable: true, // allows users to re-order by dragging
            copyable: false,  // can't copy lanes or pools
            avoidable: false,  // don't impede AvoidsNodes routed Links
            minLocation: new go.Point(NaN, -Infinity),  // only allow vertical movement
            maxLocation: new go.Point(NaN, Infinity)
          },
          new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify)
        ];
      }
      // hide links between lanes when either lane is collapsed
      function updateCrossLaneLinks(group) {
        group.findExternalLinksConnected().each(function(l) {
          l.visible = (l.fromNode.isVisible() && l.toNode.isVisible());
        });
      }
      // each Group is a "swimlane" with a header on the left and a resizable lane on the right
      myDiagram.groupTemplate =
      $$(go.Group, "Horizontal", groupStyle(),
          {
            selectionObjectName: "SHAPE",  // selecting a lane causes the body of the lane to be highlit, not the label
            resizable: true, resizeObjectName: "SHAPE",  // the custom resizeAdornmentTemplate only permits two kinds of resizing
            layout: $$(go.LayeredDigraphLayout,  // automatically lay out the lane's subgraph
              {
                isInitial: false,  // don't even do initial layout
                isOngoing: false,  // don't invalidate layout when nodes or links are added or removed
                direction: 270,
                //columnSpacing: 10,
                layeringOption: go.LayeredDigraphLayout.LayerLongestPathSource
              }),
            computesBoundsAfterDrag: true,  // needed to prevent recomputing Group.placeholder bounds too soon
            computesBoundsIncludingLinks: false,  // to reduce occurrences of links going briefly outside the lane
            computesBoundsIncludingLocation: true,  // to support empty space at top-left corner of lane
            handlesDragDropForMembers: true,  // don't need to define handlers on member Nodes and Links
          },
          new go.Binding("isSubGraphExpanded", "expanded").makeTwoWay(),
          // the lane header consisting of a Shape and a TextBlock
          $$(go.Panel, "Horizontal",
            {
              name: "HEADER",
              angle: 0,  // maybe rotate the header to read sideways going up
              alignment: go.Spot.Center
            },
            $$(go.Panel, "Horizontal",  // this is hidden when the swimlane is collapsed
              new go.Binding("visible", "isSubGraphExpanded").ofObject(),
              $$(go.TextBlock,  // the lane label
                {
                    font: "bold 13pt sans-serif",
                    editable: true,
                    margin: new go.Margin(2, 0, 0, 0),
                    width: 100,
                    textAlign: "center"
                },
                new go.Binding("text", "text").makeTwoWay())
            )
          ),  // end Horizontal Panel
          $$(go.Panel, "Auto",  // the lane consisting of a background Shape and a Placeholder representing the subgraph
            $$(go.Shape, "Rectangle",  // this is the resized object
              { name: "SHAPE", fill: "white" },
              new go.Binding("fill", "color"),
              new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify)),
            $$(go.Placeholder,
              { padding: 12, alignment: go.Spot.TopLeft }),

          )  // end Auto Panel
        );  // end Group

      myDiagram.groupTemplateMap.add("Pool",
        $$(go.Group, "Auto", groupStyle(),
          { // use a simple layout that ignores links to stack the "lane" Groups on top of each other
            layout: $$(PoolLayout, { spacing: new go.Size(0, 0) })  // no space between lanes
          },
          $$(go.Shape,
            { fill: "white" },
            new go.Binding("fill", "color")),
          $$(go.Panel, "Table",
            { defaultColumnSeparatorStroke: "black" },
            $$(go.Panel, "Horizontal",
              { column: 0, angle: 270 },
              $$(go.TextBlock,
                { font: "bold 16pt sans-serif", editable: true, margin: new go.Margin(2, 0, 0, 0) },
                new go.Binding("text").makeTwoWay())
            ),
            $$(go.Placeholder,
              { column: 1 })
          )
        ));

      myDiagram.linkTemplate =
        $$(go.Link,
          { routing: go.Link.AvoidsNodes, corner: 99 },
          { relinkableFrom: false, relinkableTo: false },
          $$(go.Shape),
          $$(go.Shape, { toArrow: "Standard" })
        );
        ///**************************************************************

        let nodeDataArray = [
        {"key":"Pool1","text":"Mapa Estratégico","isGroup":true,"category":"Pool","loc":"26.598466491699217 0.5"},
        {"key":"Lane1","text":"Financiera","isGroup":true,"group":"Pool1","color":"lightblue","loc":"53.12131399000715 0.5","size":"328.72167968750006 100"},
        {"key":"Lane2","text":"Clientes","isGroup":true,"group":"Pool1","color":"lightgreen","loc":"53.12131399000715 99.5","size":"328.72167968750006 180"},
        {"key":"Lane3","text":"Procesos Internos","isGroup":true,"group":"Pool1","color":"lightyellow","size":"328.72167968750006 86","loc":"53.12131399000715 278.5"},
        {"key":"Lane4","text":"Aprendizaje y crecimiento","isGroup":true,"group":"Pool1","color":"orange","loc":"53.12131399000715 363.5","size":"328.72167968750006 86"},
        {"key":"oneA","group":"Lane1","text":"Objetivo FA"},
        {"key":"oneB","group":"Lane1","text":"Objetivo FB"},
        {"key":"oneC","group":"Lane1","text":"Objetivo FC"},
        {"key":"oneD","group":"Lane1","text":"Objetivo FD"},
        {"key":"twoA","group":"Lane2","text":"Objetivo LA"},
        {"key":"twoB","group":"Lane2","text":"Objetivo LB"},
        {"key":"twoC","group":"Lane2","text":"Objetivo LC"},
        {"key":"twoD","group":"Lane2","text":"Objetivo LD"},
        {"key":"twoE","group":"Lane2","text":"Objetivo LE"},
        {"key":"twoF","group":"Lane2","text":"Objetivo LF"},
        {"key":"twoG","group":"Lane2","text":"Objetivo LG"},
        {"key":"fourA","group":"Lane3","text":"Objetivo A"},
        {"key":"fourB","group":"Lane3","text":"Objetivo B"},
        {"key":"fourC","group":"Lane4","text":"Objetivo C"},
        {"key":"fourD","group":"Lane4","text":"Objetivo D"},
        ]
        let linkDataArray = [
            {"from":"oneA","to":"oneB"},
            {"from":"oneA","to":"oneC"},
            {"from":"oneB","to":"oneD"},
            {"from":"oneC","to":"oneD"},
            {"from":"twoA","to":"twoB"},
            {"from":"twoA","to":"twoC"},
            {"from":"twoA","to":"twoF"},
            {"from":"twoB","to":"twoD"},
            {"from":"twoC","to":"twoD"},
            {"from":"twoD","to":"twoG"},
            {"from":"twoE","to":"twoG"},
            {"from":"twoF","to":"twoG"},
            {"from":"fourA","to":"fourB"},
            {"from":"fourC","to":"fourD"},
            {"from":"fourD","to":"fourA"},
            {"from":"fourD","to":"twoE"},
            {"from":"twoC","to":"oneC"},
            {"from":"fourC","to":"Lane3"},
        ]
        myDiagram.model = new go.GraphLinksModel(nodeDataArray,linkDataArray);
        //myDiagram.model = go.Model.fromJson(document.getElementById("dataDiagram").value);
        relayoutLanes();
    }
</script>



<script>
    var MINLENGTH = 500;  // this controls the minimum length of any swimlane
    var MINBREADTH = 20;  // this controls the minimum breadth of any non-collapsed swimlane

    // some shared functions

    // this may be called to force the lanes to be laid out again
    function relayoutLanes() {
      myDiagram.nodes.each(function(lane) {
        if (!(lane instanceof go.Group)) return;
        if (lane.category === "Pool") return;
        lane.layout.isValidLayout = false;  // force it to be invalid
      });
      myDiagram.layoutDiagram();
    }

    // this is called after nodes have been moved or lanes resized, to layout all of the Pool Groups again
    function relayoutDiagram() {
      myDiagram.layout.invalidateLayout();
      myDiagram.findTopLevelGroups().each(function(g) { if (g.category === "Pool") g.layout.invalidateLayout(); });
      myDiagram.layoutDiagram();
    }

    // compute the minimum size of a Pool Group needed to hold all of the Lane Groups
    function computeMinPoolSize(pool) {
      // assert(pool instanceof go.Group && pool.category === "Pool");
      var len = MINLENGTH;
      pool.memberParts.each(function(lane) {
        // pools ought to only contain lanes, not plain Nodes
        if (!(lane instanceof go.Group)) return;
        var holder = lane.placeholder;
        if (holder !== null) {
          var sz = holder.actualBounds;
          len = Math.max(len, sz.width);
        }
      });
      return new go.Size(len, NaN);
    }

    // compute the minimum size for a particular Lane Group
    function computeLaneSize(lane) {
      // assert(lane instanceof go.Group && lane.category !== "Pool");
      var sz = computeMinLaneSize(lane);
      if (lane.isSubGraphExpanded) {
        var holder = lane.placeholder;
        if (holder !== null) {
          var hsz = holder.actualBounds;
          sz.height = Math.max(sz.height, hsz.height);
        }
      }
      // minimum breadth needs to be big enough to hold the header
      var hdr = lane.findObject("HEADER");
      if (hdr !== null) sz.height = Math.max(sz.height, hdr.actualBounds.height);
      return sz;
    }

    // determine the minimum size of a Lane Group, even if collapsed
    function computeMinLaneSize(lane) {
      if (!lane.isSubGraphExpanded) return new go.Size(MINLENGTH, 1);
      return new go.Size(MINLENGTH, MINBREADTH);
    }

</script>
@endpush
