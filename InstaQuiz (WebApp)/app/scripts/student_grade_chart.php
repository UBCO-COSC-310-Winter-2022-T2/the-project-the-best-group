<div class="chart-container">
    <canvas id="grade-pie-chart"></canvas>
</div>

<?php 

include "get_student_grade.php"; 

?>

<script>
$(document).ready(function() {

    var grade = <?php echo json_encode($grade); ?>;
    var labels = ['Incorrect', 'Correct'];
    var colors = ["#b91d47", "#1e7145"];

    // create chart
    new Chart("grade-pie-chart", {
    type: "doughnut",
    data: {
        labels: labels,
        datasets: [{
            backgroundColor: colors,
            data: grade
        }]
    },
    options: {
        title: {
            display: true,
            text: "Grade"
        }
    }
    });

    $('#grade-pie-chart').after('<p>Correct: ' + grade[1] + ' | Incorrect: ' + grade[0] + '</p>');

});
</script>