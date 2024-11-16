
window.addEventListener("load", botones);

function botones() {
    document.getElementById("btnpublicar").addEventListener('click', validaciones);
    document.getElementById("btnModificarFoto").addEventListener('click', validacionesFotosModificar);
}


function validacionesFotosModificar(e) {
    const cantidadImagenes = $('#images').get(0).files.length;

    if (cantidadImagenes == 0) {
        //    validaExtensionImg();
        mensaje = 'seleccione las imagenes del artículo a publicar'
        $('#mensajeValidacion').text(mensaje);
        e.preventDefault();
        return false;
    }
    return false;
}

function validaciones()
{

//function validaciones(e)
//        e.preventDefault();
//        e.stopImmediatePropagation();

    $('#mensajeValidacion').addClass('ok');
    let mensaje = '';


    let ValidarImagenes = $('#requiredfoto').val().trim();

    if (ValidarImagenes == 'true') {

        const cantidadImagenes = $('#images').get(0).files.length;

        if (cantidadImagenes == 0) {
            mensaje = 'seleccione las imagenes del artículo a publicar'
            $('#mensajeValidacion').text(mensaje);
            return false;
        }
    }


    const titulo = $('#titulo').val().trim();
    if (titulo == '') {
        $('#titulo').addClass('error');
        mensaje = 'Ingrese el título del artículo'
        $('#mensajeValidacion').text(mensaje);
        return false;
    }

    const descripcion = $('#descripcion').val().trim()
    if (descripcion == '') {
        $('#descripcion').addClass('error');
        mensaje = 'Ingrese la descripción del artículo'
        $('#mensajeValidacion').text(mensaje);
        return false;
    }


    const precio = $('#precio').val().trim();
    if (precio == '') {
        $('#precio').addClass('error');
        mensaje = 'Ingrese el precio del artículo'
        $('#mensajeValidacion').text(mensaje);
        return false;
    }

//    const estado = $('#estado').val().trim();
//    if (estado == '') {
//        $('#estado').addClass('error');
//        mensaje = 'seleccione el estado del artículo'
//        $('#mensajeValidacion').text(mensaje);
//        return false;
//    }

    const ubicacion = $('#ubicacion').val().trim();
    if (ubicacion == '') {
        $('#ubicacion').addClass('error');
        mensaje = 'Ingrese la ubicación del artículo'
        $('#mensajeValidacion').text(mensaje);
        return false;
    }


    return true;

}

// CHECK FILE EXTENSION
function validar_extension(file) {
    var file_name = file.name,
            file_extension = file_name.split('.').pop();
    return valid_extensions.includes(file_extension);
}

var valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

$(document).ready(function () {

//function validaExtensionImg(e) {
    var $input = $('#images');
    $input.on('change', function (e) {
        var $this = this;
        var files = $this.files;

        // $('#mensajeValidacion').addClass('bg-light');
        $('#mensajeValidacion').text('');

        // If there is more than one file
        if (files) {
            if ($this.files.length > 1) {

                // TODO: loop for more one file

            } else {

                var file = this.files[0];
                if (validar_extension(file)) {
                    // TODO: Upload file
                    //alert('Valid extension');

                } else {

                    // Show Error
                    //alert('Invalid extension');
                    $('#mensajeValidacion').addClass('ok');
                    $('#mensajeValidacion').text('error la imagen  seleccionada no tiene la extensión [jpg, jpeg ,png, gif] ');
                    $('#images').val('');
                    return false;
                }

            }
        }
    }
    );

});



//$(document).ready(function () {
//    $("#btnpublicar").submit(validaForm);
//});
//
//function validaForm(e) {
//            e.preventDefault();
//            e.stopImmediatePropagation();
//            const form = e.target;
//            $.ajax({
//                type: "POST",
//                url: 'articulo.php',
//                data: $(this).serialize(),
//                context: form,
//                //  dataType: 'JSON',
//                success: function (response)
//                {
//                    alert(response.mensaje);
//                },
//                error: function (xhr, ajaxOptions, thrownError) {
//                    alert('henry  Error Message: ' + thrownError);
//                }
//            });
//}






//$(document).ready(function () {
//    $("#formArticulo").submit(function (e) {
//        //  $("#formArticulo").submit(function (e) {
//        e.preventDefault();
//        e.stopImmediatePropagation();
//        const form = e.target;
//        $.ajax({
//            type: "POST",
//            url: 'articulo.php',
//            data: $(this).serialize(),
//            context: form,
//            //  dataType: 'JSON',
//            success: function (response)
//            {
//                alert(response.mensaje);
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert('henry  Error Message: ' + thrownError);
//            }
//        });
//
//    });
//
//});







//function PublicarInformacion(){
//   ///ajax con boton eventi click
//$(document).ready(function () { 
//        $("#btnpublicar").click(function (e) {
//
//       /// validaciones();
//
//        e.preventDefault();
//        e.stopImmediatePropagation();
//        const form = e.target;
//
//        var valorchat = "";
//
//        $.ajax({
//            type: "POST",
//            url: 'articulo.php?action10=btnpublicar',
//            data: {
//                valorchat: valorchat
//            },
//            context: form,
//            //dataType: 'JSON',
//            success: function (response)
//            {
//                //alert(response.MensajeAlert);
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert('henry  Error Message: ' + thrownError);
//            }
//        });
//
//    });
//
//
//});
//
//
//}





















/////ajax con boton eventi click
//$(document).ready(function () {
//
//
//
//
//    $("#btnModificarFoto").click(function (e) {
//
//        e.preventDefault();
//        e.stopImmediatePropagation();
//        const form = e.target;
//
//        var valorchat = "";
//
//        $.ajax({
//            type: "POST",
//            url: 'articulo.php?action11=btnModificarFoto',
//            data: {
//                valorchat: valorchat
//            },
//            context: form,
//            //dataType: 'JSON',
//            success: function (response)
//            {
//                //alert(response.MensajeAlert);
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert('henry  Error Message: ' + thrownError);
//            }
//        });
//
//    });
//
//
//
//
//
//
//
//});
//
//
//
















//function Postback(){
//     location.href = 'articulo.php';     
//}







//ajax

//$(document).ready(function () {
//    
//    $("#formArticulo").submit(function (e) {
//    //    $("#btnSubirFotos").click(function (e) {
//        e.preventDefault();
//        e.stopImmediatePropagation();
//        const form = e.target;
//        $.ajax({
//            type: "POST",
//            url: 'articulo.php',
//            data: $(this).serialize(),
//            context: form,
//            //  dataType: 'JSON',
//            success: function (response)
//            {
////                if (response.mensaje == 'listadoProductos') {
////                    location.href = '/public/listadoProductos.php';
////                } else {
//                alert(response.mensaje);
////                }
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert('henry  Error Message: ' + thrownError);
//            }
//        });
//
//    });
//
//});
//




//$(document).ready(function () {
//    //$("#formArticulo").submit(function (e) {
//    $("#btnSubirFotos").click(function () {
//
//        let prueba = ""
//        prueba = "500"
//
//
//        $.ajax({
//            type: "POST",
//            url: 'articulo.php',
//            data: $(this).serialize(),
//          //  context: form,
//            //  dataType: 'JSON',
//            success: function (response)
//            {
////                if (response.mensaje == 'listadoProductos') {
////                    location.href = '/public/listadoProductos.php';
////                } else {
//                alert(response.mensaje);
////                }
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert('henry  Error Message: ' + thrownError);
//            }
//        });
//
//    });
//
//});
//



//$(document).ready(function () {
//    //$("#formArticulo").submit(function (e) {
//       $("#btnSubirFotos").click(function (e) {
//        e.preventDefault();
//        e.stopImmediatePropagation();
//        const form = e.target;
//        $.ajax({
//            type: "POST",
//            url: 'articulo.php',
//            data: $(this).serialize(),
//            context: form,
//            //  dataType: 'JSON',
//            success: function (response)
//            {
////                if (response.mensaje == 'listadoProductos') {
////                    location.href = '/public/listadoProductos.php';
////                } else {
//                alert(response.mensaje);
////                }
//            },
//            error: function (xhr, ajaxOptions, thrownError) {
//                alert('henry  Error Message: ' + thrownError);
//            }
//        });
//
//    });
//
//});



//   $(document).ready(function() {
//            $('#btnSubirFotos').click(function() {
//                // Collect data from form fields
////                var name = $('#name').val();
////                var email = $('#email').val();
//
//                var img=$('#imagenes');
//                var name = "nombre";
//                var email = "correo";
//                
//
//                // Make AJAX POST request
//                $.ajax({
//                    url: 'articulo.php',  // The PHP file handling the request
//                    type: 'POST',
//                    data: {
//                        name: name,
//                        email: email,
//                        img: img
//                    },
//                    success: function(response) {
//                        //$('#response').html(response);  // Display response from PHP
//                        alert(response.mensaje);
//                    },
//                    error: function(xhr, status, error) {
//                        console.log("AJAX error: " + status + " - " + error);
//                    }
//                });
//            });
//        });