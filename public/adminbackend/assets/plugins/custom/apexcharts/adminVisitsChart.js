let datesArray = [];
$.each(visits_per_day, function( key, value ) {
    datesArray.push(key);
});

let visitsArray = [];
$.each(visits_per_day, function( key, value ) {
    visitsArray.push(value);
});

var options = {
    series: [{
      name: "بازدید",
      data: visitsArray
  }],
    chart: {
    height: 350,
    type: 'line',
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  title: {
    text: 'نمودار بازدید',
    align: 'center'
  },
  grid: {
    row: {
      colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      opacity: 0.5
    },
  },
  xaxis: {
    categories: datesArray,
  }
  };

  var visits_chart = new ApexCharts(document.querySelector("#visits"), options);
  visits_chart.render();

