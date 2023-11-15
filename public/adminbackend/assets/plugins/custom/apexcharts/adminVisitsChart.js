// Global traffic dates
let datesArray = [];
$.each(visits_per_day, function( key, value ) {
  datesArray.push(key);
});

// Global traffic visits
let visitsArray = [];
$.each(visits_per_day, function( key, value ) {
 visitsArray.push(value);
});

// Iran traffic visits
let visitsArrayIran = [];
$.each(visits_per_day_iran, function( key, value ) {
    visitsArrayIran.push(value);
});

var options = {
    series: [{
    name: 'بازدید جهانی',
    data: visitsArray
  }, {
    name: 'بازدید داخلی',
    data: visitsArrayIran
  }],
    chart: {
    height: 350,
    type: 'area'
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    categories: datesArray
  },
  };

  var visits_chart = new ApexCharts(document.querySelector("#visits"), options);
  visits_chart.render();
