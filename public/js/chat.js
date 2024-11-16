
///ajax con boton eventi click
$(document).ready(function () {

    $("#btnChat").click(function (e) {

        const txtchat = $('#txtchat').val().trim();
        if (txtchat == '') {
            return false;
        }

        e.preventDefault();
        e.stopImmediatePropagation();
        const form = e.target;

        var valorchat = $('#txtchat').val();

        $.ajax({
            type: "POST",
            url: 'articulo.php?action1=btnChat',
            data: {
                valorchat: valorchat
            },
            context: form,
            //dataType: 'JSON',
            success: function (response)
            {
//                if (response.MensajeAlert == 'listadoProductos') {
//                    location.href = '/public/listadoProductos.php';
//                } else {
                //alert(response.MensajeAlert);
                $('#txtchat').val('');
                $('#divchatbox').html(response.MensajeAlert);


//                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('henry  Error Message: ' + thrownError);
            }
        });

    });


});


//
//$(document).ready(function () {
//// $(document).click(function(event){
//    $("#formArticulo").click(function (event) {
//      refreshChat(event);
//    });
//
//});

 
 
 
$(document).ready(function () {
        $('#chatArticulo').on('mouseover', function(event) {
          refreshChat(event);
       });
});


// setInterval(refreshChat,2000);  //ejecuta una funciona cada 2 segundos


function refreshChat(event) {

    event.preventDefault();
    event.stopImmediatePropagation();
    const form = event.target;

    var name = "mensajeAjax";

    $.ajax({
        type: "POST",
        url: 'articulo.php?action2=btnRefrescar',
        data: {
            name: name
        },
        context: form,
        //dataType: 'JSON',
        success: function (response)
        {
//                if (response.MensajeAlert == 'listadoProductos') {
//                    location.href = '/public/listadoProductos.php';
//                } else {
//                
            //alert(response.MensajeAlert);
            $('#divchatbox').html(response.MensajeAlert);

            //return false;
//                }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('henry  Error Message: ' + thrownError);
        }
    });




}




 