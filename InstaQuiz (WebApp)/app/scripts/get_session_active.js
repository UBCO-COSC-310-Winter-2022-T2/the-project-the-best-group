
$(document).ready(function() {

    getSessionActive();
    var interval = setInterval(getSessionActive, 5000);  //refresh comments every 5 seconds

});

function getSessionActive() {

    // AJAX function to get new comments
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