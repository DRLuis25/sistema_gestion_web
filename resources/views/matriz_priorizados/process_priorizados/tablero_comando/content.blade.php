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
    <table class="table table-bordered">
        <tr>
            <td>Proceso: </td>
            <td colspan="3">Gestión comercial</td>
            <td>Responsable: </td>
            <td colspan="3">Gerente comercial</td>
        </tr>
        <tr>
            <td>Objetivo: </td>
            <td colspan="7">
                Incrementar el nivel de satisfacción del cliente
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
        <thead>
            <tr>
                <td>Nro reclamos</td>
                <td>Sum(Reclamos)</td>
                <td>25</td>
                <td>Menos de 20</td>
                <td>Mensual</td>
                <td>
                    <row>
                        <div class="col-12" style="background-color: red">&nbsp;</div>
                        <div class="col-12">Más de 20</div>
                    </row>
                </td>
                <td>
                    <row>
                        <div class="col-12" style="background-color: yellow">&nbsp;</div>
                        <div class="col-12">De 18 a 20</div>
                    </row>
                </td>
                <td>
                    <row>
                        <div class="col-12" style="background-color:green">&nbsp;</div>
                        <div class="col-12">Menos de 18</div>
                    </row>
                </td>
            </tr>
        </thead>
    </table>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Data fuente</td>
                <td>Resultado</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2021-01</td>
                <td>21</td>
                <td style="background-color: green">15</td>
            </tr>
            <tr>
                <td>2021-02</td>
                <td>15</td>
                <td style="background-color: yellow">19</td>
            </tr>
        </tbody>
    </table>
</div>
