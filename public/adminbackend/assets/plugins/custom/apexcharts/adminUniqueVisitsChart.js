let uniqueDatesArray = [];
$.each(unique_visits_per_day, function( key, value ) {
    uniqueDatesArray.push(key);
});

let uniqueVisitsArray = [];
$.each(unique_visits_per_day, function( key, value ) {
    uniqueVisitsArray.push(value);
});

var options = {
    series: [{
      name: "تعداد بازدید کننده یکتا",
      data: uniqueVisitsArray
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
    text: 'نمودار بازدید کنندگان یکتا',
    align: 'center'
  },
  grid: {
    row: {
      colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      opacity: 0.5
    },
  },
  xaxis: {
    categories: uniqueDatesArray,
  }
  };

  var unique_chart = new ApexCharts(document.querySelector("#unique-visits"), options);
  unique_chart.render();
