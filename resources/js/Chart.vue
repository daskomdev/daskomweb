<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: {
    chartdata: {
      type: Object,
      default: {
        labels: ['TP', 'TA', 'JURNAL', 'TK', 'SKILL', 'DISKON'],

        //Example datasets
        datasets: [
            {
                label: 'Modul 1',
                backgroundColor : 'rgba(75,192,192,0.1)',
                borderColor : '#00c853',
                pointBackgroundColor: 'black', 
                borderWidth: 2, 
                pointBorderColor: 'black',
                data: [15, 15, 40, 20, 10, 10]
            },
        ]
      }
    },
    options: {
      type: Object,
      default: {
        responsive: true,
        maintainAspectRatio: false,

        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            },
            gridLines: {
              display: false
            }
          }],
          xAxes: [ {
            gridLines: {
              display: false
            },
          }]
        }
      }
    }
  },
  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}
</script>