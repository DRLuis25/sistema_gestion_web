<div class="tab-pane fade" id="mapaProceso" role="tabpanel" aria-labelledby="proceso-tab">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mapa de procesos</h1>
                </div>
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
                    @include('process_maps.historial.historial')
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
<script>
    function exportImg() {
        var img = myDiagram.makeImage({
            size : new go.Size (800,600)
        })
        var a = document.createElement('a');
        a.download = `{{$processMap->businessUnit->name}}`;
        a.target = '_blank';
        a.href= img.src;
        a.click();
    }
    function exportPdf() {
        /*var img = myDiagram.makeImage({
            size : new go.Size (800,600)
        })*/
        /*
        var doc = new jsPDF();
        var width = doc.internal.pageSize.getWidth();
        var height = doc.internal.pageSize.getHeight();
        console.log("AT#1: width=" + width + ", height=" + height);
        doc.setFontType('bold');
        doc.setFontSize(16);
        doc.text(width/3+17, 45, `Empresa: {{$processMap->businessUnit->company->name}}`);
        doc.text(width/3+17, 60, `Unidad de negocio: {{$processMap->businessUnit->name}}`);
        doc.addImage(img, 'jpg', 30, 90, 742, 495);
        doc.save(`{{$processMap->businessUnit->name}}`);*/
        var pdfOptions =  // shared by both ways of generating PDF
        {
        showTemporary: true,     // default is false
         layout: "portrait",  // instead of "portrait"
         pageSize: "A4"        // instead of "LETTER"
        };
        generatePdf(function(blob) {
            var datauri = window.URL.createObjectURL(blob);
            var a = document.createElement("a");
            a.style = "display: none";
            a.href = datauri;
            a.download = "{{$processMap->businessUnit->name}}.pdf";

            if (window.navigator.msSaveBlob !== undefined) {  // IE 11 & Edge
                window.navigator.msSaveBlob(blob, a.download);
                window.URL.revokeObjectURL(datauri);
                return;
            }

            document.body.appendChild(a);
            requestAnimationFrame(function() {
                a.click();
                window.URL.revokeObjectURL(datauri);
                document.body.removeChild(a);
            });
        }, myDiagram, pdfOptions);
    }
    function generatePdf(action, diagram, options) {
        if (!(diagram instanceof go.Diagram)) throw new Error("no Diagram provided when calling generatePdf");
        if (!options) options = {};

        var pageSize = options.pageSize || "LETTER";
        pageSize = pageSize.toUpperCase();
        if (pageSize !== "LETTER" && pageSize !== "A4") throw new Error("unknown page size: " + pageSize);
        // LETTER: 612x792 pt == 816x1056 CSS units
        // A4: 595.28x841.89 pt == 793.71x1122.52 CSS units
        var pageWidth = (pageSize === "LETTER" ? 612 : 595.28) * 96 / 72;  // convert from pt to CSS units
        var pageHeight = (pageSize === "LETTER" ? 792 : 841.89) * 96 / 72;

        var layout = options.layout || "portrait";
        layout = layout.toLowerCase();
        if (layout !== "portrait" && layout !== "landscape") throw new Error("unknown layout: " + layout);
        if (layout === "landscape") {
            var temp = pageWidth;
            pageWidth = pageHeight;
            pageHeight = temp;
        }

        var margin = options.margin !== undefined ? options.margin : 36;  // pt: 0.5 inch margin on each side
        var padding = options.padding !== undefined ? options.padding : diagram.padding;  // CSS units

        var imgWidth = options.imgWidth !== undefined ? options.imgWidth : (pageWidth-margin/72*96*2);  // CSS units
        var imgHeight = options.imgHeight !== undefined ? options.imgHeight : (pageHeight-margin/72*96*2);  // CSS units
        var imgResolutionFactor = options.imgResolutionFactor !== undefined ? options.imgResolutionFactor : 3;

        var pageOptions = {
        size: pageSize,
        margin: margin,  // pt
        layout: layout
        };
        var doc = new PDFDocument(pageOptions);
        var stream = doc.pipe(blobStream());
        var bnds = diagram.documentBounds;

        // add some descriptive text
        //doc.text(diagram.nodes.count + " nodes, " + diagram.links.count + " links  Diagram size: " + bnds.width.toFixed(2) + " x " + bnds.height.toFixed(2));

        var db = diagram.documentBounds.copy().subtractMargin(diagram.padding).addMargin(padding);
        var p = db.position;
        // iterate over page areas of document bounds
        for (var j = 0; j < db.height; j += imgHeight) {
            for (var i = 0; i < db.width; i += imgWidth) {

                // if any page has no Parts partially or fully in it, skip rendering that page
                var r = new go.Rect(p.x + i, p.y + j, imgWidth, imgHeight);
                if (diagram.findPartsIn(r, true, false).count === 0) continue;

                if (i > 0 || j > 0) doc.addPage(pageOptions);

                var makeOptions = {};
                if (options.parts !== undefined) makeOptions.parts = options.parts;
                if (options.background !== undefined) makeOptions.background = options.background;
                if (options.showTemporary !== undefined) makeOptions.showTemporary = options.showTemporary;
                if (options.showGrid !== undefined) makeOptions.showGrid = options.showGrid;
                makeOptions.scale = imgResolutionFactor;
                makeOptions.position = new go.Point(p.x + i, p.y + j);
                makeOptions.size = new go.Size(imgWidth*imgResolutionFactor, imgHeight*imgResolutionFactor);
                makeOptions.maxSize = new go.Size(Infinity, Infinity);
                /*doc.text(width/3+17, 45, `Empresa: {{$processMap->businessUnit->company->name}}`);
            doc.text(width/3+17, 60, `Unidad de negocio: {{$processMap->businessUnit->name}}`);*/
                doc.text('Empresa: {{$processMap->businessUnit->company->name}}');
                doc.text('Unidad de negocio: {{$processMap->businessUnit->name}}');
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = dd + '-' + mm + '-' + yyyy;
                doc.text(`Fecha de creación: ${today}`);
                var imgdata = diagram.makeImageData(makeOptions);
                doc.image(imgdata,{ scale: 1/(imgResolutionFactor*96/72) });
            }
        }

        doc.end();
        stream.on('finish', function() { action(stream.toBlob('application/pdf')); });
    }
</script>
@endpush
