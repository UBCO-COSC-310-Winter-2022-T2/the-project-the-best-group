
$(document).ready(function() {

    getSessionActive();
    var interval = setInterval(getSessionActive, 3000);  //refresh every 3 seconds

});

function getSessionActive() {

    // AJAX function to get if class has live session
    var cid = location.search.replace("?cid=", "");
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            if (this.responseText == 1) {
                $('#join-container').attr('class', '');
            } else {
                $('#join-container').attr('class', 'hidden');
            }
        }
    }

    xmlhttp.open("GET", "../scripts/get_session_active.php?id=" + cid, true);
    xmlhttp.send();
}