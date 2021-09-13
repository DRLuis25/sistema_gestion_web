<button type="button" class="btn btn-success float-right"
    data-toggle="modal" data-target="#graficoModal"
    data-whatever="Gráfico tendencia">
    Gráfico
</button>
<div class="modal fade" id="graficoModal" tabindex="-1" role="dialog" aria-labelledby="graficoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="graficoModalLabel">Gráfico tendencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div  class="chart-container" style="position: relative;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var myChart;
    $('#graficoModal').on('hidden.bs.modal', function () {
        let chartStatus = Chart.getChart("myChart"); // <canvas> id
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
    })
    $('#graficoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text(recipient);
        ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
