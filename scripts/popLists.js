$(document).ready(function() {
    popMat();
    function popMat() {
        $.ajax({
            url: "php/popMat.php",
            type: "GET",
            dataType: "html",
        }).done(function(ht) {
            $("#inputMat").empty();
            $("#inputMat").append(ht);
        });
    }
});