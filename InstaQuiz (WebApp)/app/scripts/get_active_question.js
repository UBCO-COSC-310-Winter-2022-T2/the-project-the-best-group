
$(document).ready(function() {

    getActiveQuestion();
    var interval = setInterval(getActiveQuestion, 5000);  //refresh every 5 seconds

});

function getActiveQuestion() {

    // AJAX function to get if question is active
    var cid = location.search.replace("?cid=", "");
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            $('#question-container')[0].innerHTML = this.responseText;
        }
    }

    xmlhttp.open("GET", "../scripts/get_active_question.php?id=" + cid, true);
    xmlhttp.send();
}