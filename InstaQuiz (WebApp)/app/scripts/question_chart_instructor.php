<?php 

include "get_previous_question_result.php"; 

if (count($answer_counts) == 0)
     exit();

echo 
"<div class='chart-container'>
    <h3>".$question_prompt."</h3>
    <canvas id='result-bar-chart'></canvas>
</div>";

?>

<script>

    var labels = ['A', 'B', 'C', 'D'];
    var values = <?php echo json_encode($answer_counts); ?>;

    // create chart
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

</script>