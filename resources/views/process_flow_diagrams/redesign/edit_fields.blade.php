<!-- Process Map Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('process_id', __('models/processFlowDiagrams.fields.process_id').':') !!}
    <p>{{$process->name}}</p>
    <input type="hidden" value="{{$process_id}}" name="process_id">
    <input type="hidden" value="{{$process_map_id}}" name="process_map_id">
</div>
<textarea name="data" id="contentDiagram" cols="30" rows="10" hidden>{{$processFlowDiagram->redesign_data}}</textarea>
<!-- Data Field -->
{{-- <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('data', __('models/processFlowDiagrams.fields.data').':') !!}
    {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
</div>
 --}}
@push('page_css')
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@8.7.1/dist/assets/diagram-js.css" />
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@8.7.1/dist/assets/bpmn-font/css/bpmn.css" />
<style>
#canvas > div > a{
    display: none;
}
</style>
@endpush
@push('scripts')
<script src="https://unpkg.com/bpmn-js@8.7.1/dist/bpmn-modeler.development.js"></script>
<script src="https://cdn.rawgit.com/abdmob/x2js/master/xml2json.js" ></script>
<script>

  var diagramUrl = 'https://cdn.staticaly.com/gh/bpmn-io/bpmn-js-examples/dfceecba/starter/diagram.bpmn';
  // modeler instance
  var bpmnModeler = new BpmnJS({
    container: '#canvas',
    keyboard: {
      bindTo: window
    }
  });
  /**
    * Save diagram contents and print them to the console.
    */
  async function exportDiagram() {
    try {
        var result = await bpmnModeler.saveXML({ format: true },function (err, xml) {
            console.log(xml);
            var X2JS = window.X2JS;
            var x2js = new X2JS();
            //const x2js = new X2JS();
            var jsonFile = x2js.xml_str2json(xml);
            console.log("JSON:");
            console.log(jsonFile);
            $("#contentDiagram").val(JSON.stringify(jsonFile));
            console.log("end call");
            $('#updateFlowDiagram-form').unbind('submit').submit();
            //openDiagram(x2js.json2xml_str(JSON.parse($("#contentDiagram").val())));
        });
      /*alert('Diagram exported. Check the developer tools!');
      console.log(result.xml);
        var parser = new DOMParser();
        var xml = parser.parseFromString(result.xml, "text/xml");
        var obj = xml2json(xml);
      //var flowDiagramJson = xml2json(result.xml,"");
      console.log($('#updateFlowDiagram-form').serialize() + `&data=${obj}`);*/
      //return result.xml;
    } catch (err) {
      console.error('could not save BPMN 2.0 diagram', err);
    }
  }
  /**
    * Open diagram in our modeler instance.
    *
    * @param {String} bpmnXML diagram to display
    */
    async function openDiagram(jsonFile) {
    // import diagram
    try {
        var X2JS = window.X2JS;
            var x2js = new X2JS();
            //const x2js = new X2JS();
            var bpmnXML = x2js.json2xml_str(jsonFile);
            console.log("JSON:");
            console.log(bpmnXML);
      await bpmnModeler.importXML(bpmnXML);
      // access modeler components
      var canvas = bpmnModeler.get('canvas');
      var overlays = bpmnModeler.get('overlays');
      // zoom to fit full viewport
      canvas.zoom('fit-viewport');
      // attach an overlay to a node
      overlays.add('SCAN_OK', 'note', {
        position: {
          bottom: 0,
          right: 0
        },
        html: '<div class="diagram-note">Mixed up the labels?</div>'
      });
      // add marker
      canvas.addMarker('SCAN_OK', 'needs-discussion');
    } catch (err) {
      console.error('could not import BPMN 2.0 diagram', err);
    }
  }
  // load external diagram file via AJAX and open it

  openDiagram(JSON.parse(document.getElementById("contentDiagram").value));
  // wire save button
  $('#save-button').click(function (e) {
      exportDiagram();
      //$('#contentDiagram').val(bpmnModeler.saveXML({ format: true }).xml);
      //return false;
  });
    $('#updateFlowDiagram-form').submit(function(event) {
        event.preventDefault();
        // your code here
        exportDiagram();
        console.log("fin exportDiagram");
    })
</script>
@endpush
