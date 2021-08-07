@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Seguimiento a las actividades</h1>
            </div>
            <div class="col-sm">
                <a class="btn btn-default float-right"
                   href="{{ route('seguimientos.index',[$company_id,$process_map_id]) }}">
                    @lang('crud.back')
                </a>
            </div>
        </div>
    </div>
</section>
<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered " id="showSeguimiento-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class=" bg-light text-dark">Actividad</th>
                                <!--TipoActividad-->
                                <td >
                                    Operación
                                </td>
                                <td >
                                    Transporte
                                </td>
                                <td >
                                    Inspección
                                </td>
                                <td >
                                    Demora
                                </td>
                                <td >
                                    Almacenaje
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!--Procesos-->
                                @php
                                    $num = 0
                                @endphp
                                @foreach ($actividades as $item)
                                    @if($actividades->where('id', '>', $item->id)->first()!==null)
                                        @php
                                            $next = $actividades->where('id', '>', $item->id)->first()->flow_id - 1;
                                        @endphp
                                    @else
                                        @php
                                            $next = "";
                                        @endphp
                                    @endif
                                    <th scope="row" class="proces bg-dark text-light" data-num="{{$num + 1}}" data-pos="{{$item->flow_id - 1}}" data-num-next="{{$num + 2}}" data-next="{{$next}}">
                                        {{$item->activity}}
                                    </th>
                                    <!--Procesos x TipoActividad-->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        @php
                                          $num = $num + 1
                                        @endphp
                                    @endforeach
                                </tr>
                          </tbody>
                    </table>
                    <canvas id="canvas" width="100" height="100">

                    </canvas>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@push('scripts')
<style>
    #canvas {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100px;
    height: 100px;
    }
</style>
    <script>
        $(function () {
            calcular();
            window.onresize = calcular;
            //$('#buttonPushMenu').click(calcular);
        });
        function calcular() {
            $('canvas').remove();
            $('#showSeguimiento-table tr:has(.proces)').each(function(i,v){
                var $cel = $(v.cells);
                console.log("pos: " + $cel.eq(0).data('pos'));
                console.log("next: " + $cel.eq(0).data('next'));
                if($cel.eq(0).data('next')!=="")
                    drawArrowOnTable('table', $cel.eq(0).data('num'), $cel.eq(0).data('pos'), $cel.eq(0).data('num-next'), $cel.eq(0).data('next')); //fila columna
            });
            // draw an arrow from (1, 0) to (2, 4)

        }
        // gets the center of a table cell relative to the document
        function getCellCenter(table, row, column) {
            var tableRow = $(table).find('tr')[row];
            var tableCell = $(tableRow).find('td')[column];

            var offset = $(tableCell).offset();
            var width = $(tableCell).innerWidth();
            var height = $(tableCell).innerHeight();

            return {
                x: offset.left + width / 2,
                y: offset.top + height / 2
            }
        }

        // draws an arrow on the document from the start to the end offsets
        function drawArrow(start, end) {
            // create a canvas to draw the arrow on
            var canvas = document.createElement('canvas');
            canvas.width = $('body').innerWidth();
            canvas.height = $('body').innerHeight();
            $(canvas).css('position', 'absolute');
            $(canvas).css('pointer-events', 'none');
            $(canvas).css('top', '0');
            $(canvas).css('left', '0');
            $(canvas).css('opacity', '0.85');
            $('body').append(canvas);

            // get the drawing context
            var ctx = canvas.getContext('2d');
            ctx.fillStyle = 'steelblue';
            ctx.strokeStyle = 'steelblue';

            // draw line from start to end
            ctx.beginPath();
            ctx.moveTo(start.x, start.y);
            ctx.lineTo(end.x, end.y);
            ctx.lineWidth = 2;
            ctx.stroke();

            // draw circle at beginning of line
            ctx.beginPath();
            ctx.arc(start.x, start.y, 4, 0, Math.PI * 2, true);
            ctx.fill();

            // draw pointer at end of line (needs rotation)
            ctx.beginPath();
            var angle = Math.atan2(end.y - start.y, end.x - start.x);
            ctx.translate(end.x, end.y);
            ctx.rotate(angle);
            ctx.moveTo(0, 0);
            ctx.lineTo(-10, -7);
            ctx.lineTo(-10, 7);
            ctx.lineTo(0, 0);
            ctx.fill();

            // reset canvas context
            ctx.setTransform(1, 0, 0, 1, 0, 0);

            return canvas;
            }

            // finds the center of the start and end cells, and then calls drawArrow
            function drawArrowOnTable(table, startRow, startColumn, endRow, endColumn) {
            drawArrow(
                getCellCenter($(table), startRow, startColumn),
                getCellCenter($(table), endRow, endColumn)
            );
        }

    </script>
@endpush
