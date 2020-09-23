$(document).ready(function(e){
    // Submit form data via Ajax
    $("#contactForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'src/contact_form.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#contactForm').css("opacity",".5");
            },
            success: function(response){ console.log(response);
                $('.statusMsg').html('');
                if(response.error == false){
                    $('#contactForm')[0].reset();
                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
                $('#contactForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
});