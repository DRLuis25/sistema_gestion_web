<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover" id="processCriterios-table">
        <thead class=" thead-light">
            <tr>
              <th ></th>
              <th scope="col" colspan="{{$criterios->count()}}" class="text-center">Factores críticos </th>
              <th ></th>
            </tr>
        </thead>
        <thead class="thead-dark text-center">
            <tr>
                <th class=" bg-light text-dark">Pesos</th>
                <!--pesos-->
                @foreach ($criterios as $item)
                    <th scope="col">{{$item->peso}}</th>
                @endforeach

                <th ></th>
            </tr>
            <tr>
                <th scope="col" class=" bg-light text-dark col-2">Procesos</th>
                <!--Criterios-->
                @php
                    $a = 100/($criterios->count()+1);
                @endphp
                @foreach ($criterios as $item)
                    <th scope="col" style="width:{{$a}}%">{{$item->name}}</th>
                @endforeach
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!--Procesos-->
                @foreach ($procesos as $item)
                    <th scope="row" class="proces bg-dark text-light" >{{$item->name}}</th>
                    <!--Procesos x Criterios-->
                    @foreach ($criterios as $item2)
                        <td >
                            <select name="proceso_id-{{$item->id}}-criterio_id-{{$item2->id}}" id="proceso_id-{{$item->id}}-criterio_id-{{$item2->id}}"  required class="form-control">
                                <option data-peso="{{$item2->peso}}" data-criterio_id="{{$item2->id}}" data-proceso_id="{{$item->id}}" data-id="0" value="">- {{-- Elegir proceso_id:{{$item->name}} criterio_id:{{$item2->name}} --}}</option>
                                <option data-peso="{{$item2->peso}}" data-criterio_id="{{$item2->id}}" data-proceso_id="{{$item->id}}" data-id="5" value="5">Muy bueno</option>
                                <option data-peso="{{$item2->peso}}" data-criterio_id="{{$item2->id}}" data-proceso_id="{{$item->id}}" data-id="4" value="4">Bueno</option>
                                <option data-peso="{{$item2->peso}}" data-criterio_id="{{$item2->id}}" data-proceso_id="{{$item->id}}" data-id="3" value="3">Regular</option>
                                <option data-peso="{{$item2->peso}}" data-criterio_id="{{$item2->id}}" data-proceso_id="{{$item->id}}" data-id="2" value="2">Malo</option>
                                <option data-peso="{{$item2->peso}}" data-criterio_id="{{$item2->id}}" data-proceso_id="{{$item->id}}" data-id="1" value="1">Muy Malo</option>
                            </select>
                        </td>
                    @endforeach
                    <th scope="row" class="bg-dark text-light text-center" style="width: 5%"><input type="text" disabled id="proces{{$item->id}}" style="width:50px"></th>
                    </tr>
                    <tr>
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
            });
        }
    </script>
@endpush
