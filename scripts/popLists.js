$(document).ready(function() {
    $("#createNewMaterial").on('hide.bs.modal', function () {
        popMat();
        //console.log("hidden");
        $("#inputMat").empty();
        $('#materialInput').val("");
    });
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