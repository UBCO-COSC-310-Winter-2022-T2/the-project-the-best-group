<div class="chart-container">
    <canvas id="attendance-pie-chart"></canvas>
</div>

<?php 

include "get_student_attendance.php"; 

?>

<script>
$(document).ready(function() {

    var attendance = <?php echo json_encode($attendance); ?>;
    
    var labels = ['Missed', 'Attended'];
    var colors = ["#b91d47", "#1e7145"];

    // create chart
    new Chart("attendance-pie-chart", {
    type: "doughnut",
    data: {
        labels: labels,
        datasets: [{
            backgroundColor: colors,
            data: attendance
        }]
    },
    options: {
        title: {
            display: true,
            text: "Attendance"
        }
    }
    });

    $('#attendance-pie-chart').after('<p>Attended: ' + attendance[1] + ' | Missed ' + attendance[0] + '</p>');

});
</script>