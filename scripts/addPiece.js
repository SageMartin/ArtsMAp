$(document).ready(function() {
    // $('#submision').click(function(event) {
    //     alert("click");
    // })
    $('#info').submit(function(event){
        event.preventDefault()
        addPiece()
        //console.log("ok")
        //alert("go");
    });
    function addPiece() {
        //console.log("Ok")
        $.ajax({
        url: "add2.php",
        data:  $('#info').serialize(),
        type: "POST",
        dataType: "html",
        }).done(function(ht) {
            //$("#output").innerHTML = ht;
            $("#output").replaceWith( "<div id='output'>" + ht + "</div>")
            //alert(ht);
            //console.log(ht);
        }).fail(function( xhr, status, errorThrown ) {
            alert( "Sorry, there was a problem!" );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        });
        // $.post( "add2.php", $('#info').serialize(), function(response) {
        //         document.getElementById("output").innerHTML = response;
        // });
    }
});