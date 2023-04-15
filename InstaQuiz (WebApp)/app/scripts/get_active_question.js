
// these track if the chart needs to be refreshed to prevent always refreshing every 5 seconds
var refresh_chart = true;
var previous_question_html = '';

$(document).ready(function() {

    getActiveQuestion();
    createChart();
    var interval1 = setInterval(getActiveQuestion, 2000);  //refresh every 5 seconds 
    var interval2 = setInterval(createChart, 2000);  //refresh every 5 seconds 

});

function getActiveQuestion() {
    
    // AJAX function to get if question is active
    var cid = location.search.replace("?cid=", "");
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            if (previous_question_html != this.responseText)
                refresh_chart = true;
            previous_question_html = this.responseText;
            $('#question-container')[0].innerHTML = this.responseText;
        }
    }

    xmlhttp.open("GET", "../scripts/get_active_question.php?cid=" + cid, true);
    xmlhttp.send();
}

function createChart() {

    if (!refresh_chart) 
        return;
    

    // AJAX function to get chart data
    var cid = location.search.replace("?cid=", "");
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            getChart(this.responseText);
        }
    }

    xmlhttp.open("GET", "../scripts/get_previous_question_result.php?cid=" + cid, true);
    xmlhttp.send();
}

function getChart(values) {

    refresh_chart = false;
    var labels = ['A', 'B', 'C', 'D'];

    new Chart("result-bar-chart", {
    type: "bar",
    data: {
        labels: labels,
        datasets: [{
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            data: values
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
            display: false
        }
    }
    });

}