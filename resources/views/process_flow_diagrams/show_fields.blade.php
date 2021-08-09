<!-- Process Id Field -->
<div class="col-sm-12">
    {!! Form::label('process_id', __('models/processFlowDiagrams.fields.process_id').':') !!}
    <p>{{ $processFlowDiagram->process->name }}</p>
</div>

<!-- Data Field -->
{{-- <div class="col-sm-12">
    {!! Form::label('data', __('models/processFlowDiagrams.fields.data').':') !!}
    <p>{{ $processFlowDiagram->data }}</p>
</div> --}}

<textarea name="dataDiagram" id="dataDiagram" hidden>{{$processFlowDiagram->data}}</textarea>
@push('page_css')
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@8.7.1/dist/assets/diagram-js.css" />
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@8.7.1/dist/assets/bpmn-font/css/bpmn.css" />
<style>
#canvas > div > a{
    display: none;
}
</style>
@endpush
@push('scripts'){{--
<script src="https://unpkg.com/bpmn-js@8.7.1/dist/bpmn-modeler.development.js"></script> --}}
<script src="https://unpkg.com/bpmn-js@8.7.1/dist/bpmn-navigated-viewer.development.js"></script>
<script src="https://cdn.rawgit.com/abdmob/x2js/master/xml2json.js" ></script>
<script>

  //var diagramUrl = 'https://cdn.staticaly.com/gh/bpmn-io/bpmn-js-examples/dfceecba/starter/diagram.bpmn';
  // modeler instance
  var bpmnModeler = new BpmnJS({
    container: '#canvas',
    keyboard: {
      bindTo: window
    }
  });
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
  //$.get(diagramUrl, openDiagram, 'text');
  openDiagram(JSON.parse(document.getElementById("dataDiagram").value));
  // wire save button
</script>
@endpush
