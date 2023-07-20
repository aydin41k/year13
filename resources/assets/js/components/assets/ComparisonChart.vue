<script>
import { Line } from 'vue-chartjs'
export default {
  props: {
    occupation_data: Object,
  },
  extends: Line,
  data () {
    return {
      chartData: {
        labels: [],
        datasets: []
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            },
            gridLines: {
              display: true
            }
          }],
          xAxes: [ {
            gridLines: {
              display: false
            },
            ticks: {
              display: (window.innerWidth > 768)
            }
          }]
        },
        legend: {
          display: true
        },
        responsive: true,
        maintainAspectRatio: false,
      }
    }
  },
  methods: {
    getSignificantSkills(set) {
      let significantSkills = [];
      for (let skill in set) {
        if (set[skill] >= 50) {
          significantSkills.push(skill);
        }
      }
      return significantSkills;
    },
    generateDataset(occupation) {
      return {
        label: occupation.name,
        data: this.chartData.labels.map(skill => occupation.data[skill] || 0),
        fill: false,
        borderWidth: 3
      }
    }
  },
  mounted () {
    // Assign the skills that are significant to both occupations to the labels
    this.chartData.labels = this.getSignificantSkills(this.occupation_data.occupation_1.data)
        .filter(skill => this.getSignificantSkills(this.occupation_data.occupation_2.data).includes(skill));

    // Build datasets
    this.chartData.datasets = [
      this.generateDataset(this.occupation_data.occupation_1),
      this.generateDataset(this.occupation_data.occupation_2)
    ]

    // Give the borderColor and backgroundColor to the datasets
    this.chartData.datasets[0].borderColor = '#f709fe';
    this.chartData.datasets[0].backgroundColor = '#f709fe';
    this.chartData.datasets[1].borderColor = '#48cfec';
    this.chartData.datasets[1].backgroundColor = '#48cfec';

    this.renderChart(this.chartData, this.options);
  }
}
</script>