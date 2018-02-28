$(document).ready(function() {
    $('#submitMaterial').click(function(event) {
        createMaterial();
    });
    
    function createMaterial() {
        console.log($('#materialInput').val());
        $.ajax({
            url: "php/createMat.php",
            data: {
                input: $('#materialInput').val()
            },
            
            type: "POST",
            dataType: "html",
        }).done(function(ht) {
            $('#matConformation').empty();
            $('#matConformation').append(ht);
            //$('#createNewMaterial').modal('hide');
        });
    }
});