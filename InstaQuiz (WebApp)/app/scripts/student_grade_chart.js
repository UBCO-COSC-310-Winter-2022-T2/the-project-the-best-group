$(document).ready(function() {

    var grade = getGrade();

    // create chart data
    const data = {
        label: 'Grade',
        borderColor: 'rgb(54, 162, 235)',
        data: grade
    };

    // create chart
    new Chart("grade-pie-chart", {
        type: "pie",
        data,
    });

});

function getGrade() {

    // AJAX function to get if question is active
    var cid = location.search.replace("?cid=", "");
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            return this.responseText;
        }
    }

    xmlhttp.open("GET", "../scripts/get_student_grade.php?id=" + cid, true);
    xmlhttp.send();
}