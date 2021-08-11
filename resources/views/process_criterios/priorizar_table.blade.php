<div class="table-responsive col-4">
    <table class="table table-bordered table-striped table-hover" id="processCriterios-table">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">#</th>
                <th >Proceso</th>
                <th class="text-center">Valor </th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            <tr>
                <!--Procesos-->
                @foreach ($procesosPriorizados as $item)
                    <th scope="row" class="text-center">{{$i}}</th>
                    <td>{{$item->name}}</td>
                    <td class="text-center">{{$item->value}}</td>
                    </tr>
                    <tr>
                        @php
                            $i=$i+1;
                        @endphp
                @endforeach
                </tr>
          </tbody>
    </table>
</div>


@push('scripts')
    <script>
        $(function () {
            $.get(`/getMatrizPriorizacion/{{$process_map_id}}`, function(res, sta){
                if (res.matriz) {
                    $("#asdasd").attr("hidden",false);
                    const matriz = JSON.parse(res.matriz.data);
                    console.log(matriz);
                    jQuery.each(matriz, function(i, val) {
                        console.log(i);
                        console.log(val);
                        $("#" + i).val(val);
                    });
                    calcularTotal();
                }
            });
            $('select').change(function(){
                //console.log($(this).data('proceso_id'));
                //console.log($(this).data('criterio_id'));
                //console.log($(this).children('option:selected').data('id'));
                calcularTotal();
            });
        })
        function calcularTotal() {
            $('#processCriterios-table tr:has(.proces)').each(function(i,v){
                var $cel = $(v.cells);
                //console.log("cel");
                var $numcriterios = v.cells.length-2;
                //console.log(v.cells);
                var subtotal = 0;
                for (let index = 0; index < $numcriterios; index++) {
                    subtotal = subtotal + $cel.eq(1 + index).find('option:selected').data('id')*$cel.eq(1 + index).find('option:selected').data('peso');
                }
                let procesoselect = $cel.eq(1).find('option:selected').data('proceso_id');
                $(`#proces${procesoselect}`).val(subtotal);
                $(`#proceso${procesoselect}`).val(subtotal);
                $(`#proceso-id-${procesoselect}`).val(procesoselect);
            });
        }
    </script>
@endpush
