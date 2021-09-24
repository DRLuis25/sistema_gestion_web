<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tablero de comando</h1>
            </div>
            @can('registrar_data_fuente')
                <div class="col-sm-6">
                    {{-- @include('matriz_priorizados.process_priorizados.objetivos.create') --}}
                    @include('matriz_priorizados.process_priorizados.tablero_comando.grafico')
                    @include('matriz_priorizados.process_priorizados.tablero_comando.data_fuente.content')
                </div>
            @endcan
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="form-group col-4">
            <label for="formula" class="col-form-label">Indicador:</label>
            <select class="form-control" id="indicador_select">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="1">Indicador 1</option>
                <option value="2">Indicador 2</option>
                <option value="3">Indicador 3</option>
            </select>
        </div>
    </div>
    <div id="head-indicador">

    </div>

    <div id="datos-indicador">

    </div>
</div>
@push('scripts')
<script>
    /*$(function () {
        $.get(`/api/getIndicadores/{{$matriz_priorizado_id}}/{{$process_id}}/${orden}`, function(res, sta){
                $("#effect_id").empty();
                res.forEach(element => {
                    $("#effect_id").append(`<option value=${element.id}> ${element.descripcion} </option>`);
                });
        });
    });*/
    $("#indicador_select").change(event => {
        let indicador_id = $("#indicador_select").find(':selected').val();
        $.get(`/api/indicators/${indicador_id}`, function(res, sta){
            $("#effect_id").empty();
            //Head tabla
            indicador = res.data;
            $('#head-indicador').html(`
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Proceso: </td>
                            <td colspan="3">{{$proceso->name}}</td>
                            <td>Responsable: </td>
                            <td colspan="3">${indicador.responsable}</td>
                        </tr>
                        <tr>
                            <td>Objetivo: </td>
                            <td colspan="7">
                                ${indicador.objetivo}
                            </td>
                        </tr>
                        <tr>
                            <td>Indicador</td>
                            <td>Fórmula</td>
                            <td>Línea base</td>
                            <td>Valor meta</td>
                            <td>Frecuencia</td>
                            <td colspan="3" class="text-center">Semáforo</td>
                        </tr>
                        <tr>
                            <td>${indicador.descripcion}</td>
                            <td>${indicador.formula}</td>
                            <td>${indicador.linea_base}</td>
                            <td>Menos de ${indicador.meta}</td>
                            <td>${indicador.frecuencia}</td>
                            <td>
                                <row>
                                    <div class="col-12" style="background-color: red">&nbsp;</div>
                                    <div class="col-12">Menos de ${indicador.rojo}</div>
                                </row>
                            </td>
                            <td>
                                <row>
                                    <div class="col-12" style="background-color: yellow">&nbsp;</div>
                                    <div class="col-12">De ${indicador.rojo} a ${indicador.verde}</div>
                                </row>
                            </td>
                            <td>
                                <row>
                                    <div class="col-12" style="background-color:green">&nbsp;</div>
                                    <div class="col-12">Más de ${indicador.verde}</div>
                                </row>
                            </td>
                        </tr>
                    </thead>
                </table>
            `);
            //Body tabla (data-fuente)
            $('#datos-indicador').html(`
                <table class="table table-bordered text-center" id='datos-indicador-tabla'>
                    <thead>
                        <tr>
                            <td>Fecha</td>
                            <td>Data fuente</td>
                            <td>Resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            `);
            //Supongo que getDataFuente
            console.log(res);
            res.data.data_fuentes.forEach(element => {
                anio = new Date(element.fecha).getFullYear();
                mes = (new Date(element.fecha).getMonth()+1).toString();
                dia = new Date(element.fecha).getDate();
                switch (indicador.frecuency_id) {
                    case 1:
                        fecha = dia + '/' + mes + '/'+ anio;
                        break;
                    case 2:
                        fecha = dia + '/' + mes + '/'+ anio;
                        break;
                    case 3:
                        fecha = mes + '/'+ anio;
                        break;
                    case 4:
                        fecha = anio;
                        break;
                }
                if (element.valor > indicador.verde) {
                    color = 'green'
                }
                else
                if (element.valor > indicador.rojo) {
                    color = 'yellow'
                }
                else{
                    color = 'red'
                }
                $("#datos-indicador-tabla").append(`
                    <tr>
                        <td>${fecha}</td>
                        <td>${element.valor}</td>
                        <td style="background-color: ${color}">${element.valor}</td>
                    </tr>
                `);
            });


        }).fail(function (data) {
            alert('Error al obtener los datos');
            $('#head-indicador').html(``);
            $('#datos-indicador').html(``);
        });


    });
</script>
@endpush
