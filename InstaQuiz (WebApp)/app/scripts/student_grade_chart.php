<div class="chart-container">
    <canvas id="grade-pie-chart"></canvas>
</div>

<?php 

include "get_student_grade.php"; 

?>

<script>
$(document).ready(function() {

    var grade = <?php echo $grade; ?>;
    var labels = ['Incorrect', 'Correct'];
    var values = [100 - grade, grade];
    var colors = ["#b91d47", "#1e7145"];

    // create chart
    new Chart("grade-pie-chart", {
    type: "doughnut",
    data: {
        labels: labels,
        datasets: [{
            backgroundColor: colors,
            data: values
        }]
    },
    options: {
        title: {
            display: true,
            text: "Grade"
        }
    }
    });

});
</script>