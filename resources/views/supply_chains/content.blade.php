<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="customers" role="tabpanel" aria-labelledby="customers-tab">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@lang('models/supplyChainCustomers.plural')</h1>
                    </div>
                    @can('registrar_cliente_cadena_suministro')
                        <div class="col-sm-6">
                            @include('supply_chains.customers.create')
                        </div>
                    @endcan
                </div>
            </div>
        </section>
        <table class="table table-bordered table-striped table-hover ajaxTable datatable data-table2" id="supplyChainCustomers-table">
            <thead>
                <tr>
                    <th style="color:white">x</th>
                    {{-- <th>@lang('models/supplyChainCustomers.fields.supply_chain_id')</th> --}}
                    <th>@lang('models/supplyChainCustomers.fields.customer_id')</th>
                    <th>@lang('models/supplyChainCustomers.fields.parent_customer_id')</th>
                    <th>@lang('models/supplyChainCustomers.fields.level_id')</th>
                    <th width="100px">@lang('crud.action')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
</div>

@push('scripts')
<script src="https://gojs.net/latest/extensions/SpiralLayout.js"></script>
<script>
    $(function () {
        let table = $('.data-table2').DataTable({
            "autoWidth": false,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            languages:{
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            },
            select:true,
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0,
                data: null,
            } ],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                'selectAll',
                'selectNone',
                'colvis',
                {

                    extend: 'copyHtml5',
                    title: '',
                    text: 'Copiar',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: '',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: '',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: '',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: '',
                    exportOptions: {
                        columns: ':visible'/*
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }*/
                    }
                },
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('getSupplyChainCusto',[$supplyChain->businessUnit->id])}}",
            columns: [
                { "data":null, render:function(){return "";}},
                // { data: 'supply_chain_name', name: 'supply_chain_name'},
                { data: 'customer_name', name: 'customer_name'},
                { data: 'parent_customer_name', name: 'parent_customer_name'},
                { data: 'level', name: 'level'},
                { data: 'action', name: 'Action', orderable: false, searchable: false},
            ],
            orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            pageLength: 10,
        });
        let table2 = $('.data-table').DataTable({
            "autoWidth": false,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            languages:{
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            },
            select:true,
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0,
                data: null,
            } ],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                'selectAll',
                'selectNone',
                'colvis',
                {

                    extend: 'copyHtml5',
                    title: '',
                    text: 'Copiar',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: '',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: '',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: '',
                    exportOptions: {
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: '',
                    exportOptions: {
                        columns: ':visible'/*
                        columns: function (idx, data, node) {
                            if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                return false;
                            return true;
                        }*/
                    }
                },
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('getSupplyChainSupp',[$supplyChain->businessUnit->id])}}",
            columns: [
                { "data":null, render:function(){return "";}},
                { data: 'supplier_name', name: 'supplier_name'},
                { data: 'parent_supplier_name', name: 'parent_supplier_name'},
                { data: 'level', name: 'level'},
                { data: 'action', name: 'Action', orderable: false, searchable: false},
            ],
            orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            pageLength: 10,
        });
        let table3 = $('.data-table3').DataTable({
            "autoWidth": false,
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0,
                    data: null,
                }],
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
                processing: true,
                serverSide: true,
                //ajax: "{{ route('historials.index')}}",
                ajax: "{{ route('getHistorial',[$supplyChain->id])}}",
                columns: [
                    { "data":null, render:function(){return "";}},
                    { data: 'description', name: 'description'},
                    { data: 'created', name: 'created'},
                    { data: 'action', name: 'Action', orderable: false, searchable: false},
                ],
                orderCellsTop: true,
                order: [[ 2, 'asc' ]],
                pageLength: 10,
            });
        init();
    });
    function init() {
        //Diagrama
        var $$ = go.GraphObject.make;
        myDiagram = $$(go.Diagram, "myDiagramDiv",{
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
        //myDiagram.layout = new go.TreeLayout();
        /*myDiagram.layout =
        $$(go.TreeLayout,
            { angle: 0, layerSpacing: 60 });*/
        /*myDiagram.linkTemplate =$$(go.Link,
            new go.Binding("routing", "routing"),
            $$(go.Shape),
            $$(go.Shape, { toArrow: "Standard" })
        );*/
        myDiagram.linkTemplate =
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
        );
        let nodeDataArray = [{"key": 0, 'name': 'Esta Empresa' }];
        let linkDataArray = [];
        $.get(`/generateSupplyChain/{{$supplyChain->id}}`, function(res, sta){
            const customers = res.customers;
            const suppliers = res.suppliers;
            suppliers.forEach(c => {
            if (nodeDataArray.findIndex(e =>  e.key === c.id ) === -1)
                nodeDataArray.push({
                    "key": c.id,
                    "name": c.name
                });
                linkDataArray.push({
                "from": c.id,
                "to": c.parent_id,
                "routing": go.Link.AvoidsNodes
                });
            });
            customers.forEach(c => {
                if (nodeDataArray.findIndex(e =>  e.key === c.id ) === -1)
                nodeDataArray.push({
                    "key": c.id,
                    "name": c.name
                });
                linkDataArray.push({
                "from": c.parent_id,
                "to":c.id,
                "routing": go.Link.AvoidsNodes
                });
            });
            myDiagram.model = new go.GraphLinksModel(nodeDataArray,linkDataArray);
        });
    }
    function replaceDiagram() {
        var $$ = go.GraphObject.make;
        myDiagram.div = null;
        myDiagram = $$(go.Diagram, "myDiagramDiv",{
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
        myDiagram.linkTemplate =
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
        );
        let nodeDataArray = [{"key": 0, 'name': 'Esta Empresa' }];
        let linkDataArray = [];
        $.get(`/generateSupplyChain/{{$supplyChain->id}}`, function(res, sta){
            const customers = res.customers;
            const suppliers = res.suppliers;
            suppliers.forEach(c => {
            if (nodeDataArray.findIndex(e =>  e.key === c.id ) === -1)
                nodeDataArray.push({
                    "key": c.id,
                    "name": c.name
                });
                linkDataArray.push({
                "from": c.id,
                "to": c.parent_id,
                "routing": go.Link.AvoidsNodes
                });
            });
            customers.forEach(c => {
                if (nodeDataArray.findIndex(e =>  e.key === c.id ) === -1)
                nodeDataArray.push({
                    "key": c.id,
                    "name": c.name
                });
                linkDataArray.push({
                "from": c.parent_id,
                "to":c.id,
                "routing": go.Link.AvoidsNodes
                });
            });
            myDiagram.model = new go.GraphLinksModel(nodeDataArray,linkDataArray);
        });
    }
    function exportImg() {
        var img = myDiagram.makeImage({
            size : new go.Size (800,600)
        })
        var a = document.createElement('a');
        a.download = `{{$supplyChain->businessUnit->name}}`;
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
        doc.text(width/3+17, 45, `Empresa: {{$supplyChain->businessUnit->company->name}}`);
        doc.text(width/3+17, 60, `Unidad de negocio: {{$supplyChain->businessUnit->name}}`);
        doc.addImage(img, 'jpg', 30, 90, 742, 495);
        doc.save(`{{$supplyChain->businessUnit->name}}`);*/
        var pdfOptions =  // shared by both ways of generating PDF
        {
        showTemporary: true,     // default is false
         layout: "landscape",  // instead of "portrait"
         pageSize: "A4"        // instead of "LETTER"
        };
        generatePdf(function(blob) {
            var datauri = window.URL.createObjectURL(blob);
            var a = document.createElement("a");
            a.style = "display: none";
            a.href = datauri;
            a.download = "myDiagram.pdf";

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
                /*doc.text(width/3+17, 45, `Empresa: {{$supplyChain->businessUnit->company->name}}`);
            doc.text(width/3+17, 60, `Unidad de negocio: {{$supplyChain->businessUnit->name}}`);*/
                doc.text('Empresa: {{$supplyChain->businessUnit->company->name}}');
                doc.text('Unidad de negocio: {{$supplyChain->businessUnit->name}}');
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
