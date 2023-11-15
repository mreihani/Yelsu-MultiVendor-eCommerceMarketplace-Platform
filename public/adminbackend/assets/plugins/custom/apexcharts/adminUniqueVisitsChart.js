// Global unique traffic dates
let uniqueDatesArray = [];
$.each(unique_visits_per_day, function( key, value ) {
    uniqueDatesArray.push(key);
});

// Global unique traffic visits
let uniqueVisitsArray = [];
$.each(unique_visits_per_day, function( key, value ) {
    uniqueVisitsArray.push(value);
});

// Iran unique traffic visitors
let uniqueVisitsArrayIran = [];
$.each(unique_visits_per_day_iran, function( key, value ) {
    uniqueVisitsArrayIran.push(value);
});

var options = {
    series: [{
    name: 'بازدیدکنندگان یکتا جهانی',
    data: uniqueVisitsArray
}, {
    name: 'بازدیدکنندگان یکتا داخلی',
    data: uniqueVisitsArrayIran
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
    categories: uniqueDatesArray
    },
};

var unique_chart = new ApexCharts(document.querySelector("#unique-visitors"), options);
unique_chart.render();
