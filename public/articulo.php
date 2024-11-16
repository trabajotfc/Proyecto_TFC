<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";



use eftec\bladeone\BladeOne;
use App\BD;
use App\clsArticulo;
use App\clsConsultas;
use App\clsAnuncio;
use App\clsChat;

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$blade = new BladeOne($views, $cache);

$bd = BD::getConexion();

//$_SESSION['idAnuncio'] = 1;
//$_SESSION['idArticulo'] = 1;


$Articulo = new clsArticulo($bd);
$consultas = new clsConsultas($bd);
$Anuncio = new clsAnuncio($bd);
$objChat = new clsChat($bd);

$idArticulo = "0";

$ListarTipoVenta = '';
$titulo = "";
$descripcion = "";
$precio = 0;
$estado = "";
$ubicacion = "";
$mensajeValidacion = "";
$htmlImagenes = '';
$modificarfotos = "none"; //oculto  -> auto->visible
$requiredfoto = "true";

$ParametroListarEstadoArticulo = "0";
$ParametroListarCategoria = "0";
$ParametroListarTipoVenta = "0";
$comprar = "";
$compraDeshabilitar = "false";
$ListarArticulo = $consultas->BuscarArticulo($_SESSION['idArticulo']);

$requiereChat = "";

foreach ($ListarArticulo as $clave => $valor) {
    try {
        //$listado[$clave] = [$valor->Titulo];
        $ParametroListarEstadoArticulo = $valor->idEstado;
        $ParametroListarCategoria = $valor->idCategoria;
        $ParametroListarTipoVenta = $valor->idTipoVenta;
        $titulo = $valor->Titulo;
        $precio = $valor->Precio;
        $ubicacion = $valor->Ubicacion;
        $descripcion = $valor->Descripcion;

        $modificarfotos = "auto"; //tiene fotos grabadas, se visible habilita el boton modificar fotos
        $requiredfoto = "false";
    } catch (PDOException $ex) {
        error_log("Error al recuperar el producto " . $ex->getMessage());
    }
}



if (!empty($_POST)) {//INICIO  AJAX    
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {//INICIO  AJAX    
//    if (isset($_POST['btnSubirFotos'])) {
//        $mensaje = "";
//        $mensaje = "SUBIR FOTOS";
//        $response = compact('mensaje');
//        header('Content-type: application/json');
//        echo json_encode($response);
//        die;
//    }
//    
    //if (isset($_GET['action10']) == "btnpublicar") {
    if (isset($_POST['btnpublicar'])) {

// AJAX
//    //$response = compact('mensajeprueba', 'errorPassword', 'errorEmail','henry');
//    $mensaje = "";
//    $mensaje = "El usuario no Existe";
//    $response = compact('mensaje');
//    header('Content-type: application/json');
//    echo json_encode($response);
//    die;
//    FIN DE AJAX
        //  $ObjArticulo = $Articulo->NuevoCodigoArticulo();

        $idArticulo = $_SESSION['idArticulo'];

        $borrarImagenes = false;
        if (!empty($_FILES['images']['name'][0])) {
            $borrarImagenes = true;
        }

        if ($borrarImagenes == true) {
            BorrarFicherosFotos();
            $BorrarFoto = $Articulo->BorrarFoto($idArticulo);
            GrabarImagen();
        }

        MostrarImagenes();

        $htmlImagenes = $_SESSION['htmlImagenes'];

        $titulo = trim(filter_input(INPUT_POST, 'titulo'));
        $descripcion = trim(filter_input(INPUT_POST, 'descripcion'));
        $precio = trim(filter_input(INPUT_POST, 'precio'));
        $idTipoVenta = trim(filter_input(INPUT_POST, 'tipoventa'));
        $idCategoria = trim(filter_input(INPUT_POST, 'categoria'));
        $idEstado = trim(filter_input(INPUT_POST, 'estado'));
        $ubicacion = trim(filter_input(INPUT_POST, 'ubicacion'));

        $ParametroListarEstadoArticulo = $idEstado;
        $ParametroListarCategoria = $idCategoria;
        $ParametroListarTipoVenta = $idTipoVenta;

        $BorrarAnuncioDetalle = $Articulo->BorrarAnuncioDetalleArticulo($idArticulo);

        $tieneAnuncio = $Anuncio->BuscarAnuncioPorUsuario($_SESSION['idUsuario']);
        if ($tieneAnuncio == false) {
            $Anuncio->GrabarAnuncio($_SESSION['idAnuncio'], $_SESSION['idUsuario']);
        }


        $BorrarArticulo = $Articulo->BorrarArticulo($idArticulo);
        $GrabarArticulo = $Articulo->GrabarArticulo($idArticulo, $titulo, $descripcion, $precio, $idTipoVenta, $idCategoria, $idEstado, $ubicacion);
        $GrabaAnuncioArticuloDetalle = $Anuncio->GrabarAnuncioArticuloDetalle($_SESSION["idAnuncio"], $_SESSION["idArticulo"]);

        $mensajeValidacion = $GrabarArticulo;

        $ListarEstadoArticulo = $consultas->ListarEstadoArticulo();
        $ListarCategoria = $consultas->ListarCategoria();
        $ListarTipoVenta = $consultas->ListarTipoVenta();

        $modificarfotos = "auto"; //tiene fotos grabadas, se visible habilita el boton modificar fotos
        $requiredfoto = "false";

        $chatVisible = "";
        $comprar = $_SESSION['Comprar'];
        $activarCompra = "";
        $requiereChat = "";
        if ($comprar != null) {
            $activarCompra = "none";    //hay compra
            $compraDeshabilitar = " disabled='true' ";
            $chatVisible = "auto";
            $requiereChat = "required='true'";
        } else {
            $activarCompra = "auto";    //no hay compra
            $compraDeshabilitar = " ";
            $chatVisible = "none";
        }



        echo $blade->run('articulo',
                compact('titulo', 'descripcion', 'precio',
                        'estado', 'ubicacion',
                        'htmlImagenes', 'ListarEstadoArticulo',
                        'ListarCategoria', 'ListarTipoVenta', 'mensajeValidacion',
                        'ParametroListarEstadoArticulo',
                        'ParametroListarCategoria', 'ParametroListarTipoVenta',
                        'modificarfotos', 'requiredfoto', 'activarCompra', 'compraDeshabilitar', 'chatVisible', 'requiereChat')
        );

        die;
    }

    //if (isset($_GET['action11']) == "btnModificarFoto") {
    if (isset($_POST['btnModificarFoto'])) {

        $idArticulo = $_SESSION['idArticulo'];

        $ListarEstadoArticulo = $consultas->ListarEstadoArticulo();
        $ListarCategoria = $consultas->ListarCategoria();
        $ListarTipoVenta = $consultas->ListarTipoVenta();

        $borrarImagenes = false;
        if (!empty($_FILES['images']['name'][0])) {
            $borrarImagenes = true;
        }

        if ($borrarImagenes == true) {
            BorrarFicherosFotos();
            $BorrarFoto = $Articulo->BorrarFoto($idArticulo);
            GrabarImagen();
        }


        MostrarImagenes();

        $htmlImagenes = $_SESSION['htmlImagenes'];
        $requiredfoto = "true";
        $mensajeValidacion = "las fotos se han actualizado correctamente";

        $comprar = $_SESSION['Comprar'];
        $activarCompra = "";
        $chatVisible = "";
        $requiereChat = "";
        if ($comprar != null) {
            $activarCompra = "none";    //hay compra
            $compraDeshabilitar = " disabled='true' ";
            $chatVisible = "auto";
            $requiereChat = "required='true'";
        } else {
            $activarCompra = "auto";    //no hay compra
            $compraDeshabilitar = "  ";
            $chatVisible = "none";
        }



        echo $blade->run('articulo',
                compact('titulo', 'descripcion', 'precio',
                        'estado', 'ubicacion',
                        'htmlImagenes', 'ListarEstadoArticulo',
                        'ListarCategoria', 'ListarTipoVenta', 'mensajeValidacion',
                        'ParametroListarEstadoArticulo',
                        'ParametroListarCategoria',
                        'ParametroListarTipoVenta',
                        'modificarfotos', 'requiredfoto', 'activarCompra', 'compraDeshabilitar', 'chatVisible', 'requiereChat'));
        die;
    }


    if (isset($_GET['action1']) == "btnChat") {
        $idUsuarioCompra = 2;

        $readFichero = "";
        // mensaje en el chat       
        $txtMensaje = htmlspecialchars($_POST['valorchat']);

        $idUsuarioPropietarioArticulo = "";
        $idUsuarioPropietarioArticulo = $consultas->BuscarUsuarioPropietarioArticulo($_SESSION["idArticulo"]);

        foreach ($idUsuarioPropietarioArticulo as $clave => $valor) {
            $idUsuarioPropietarioArticulo = $valor->idUsuario;
        }

        // ***estructura del nombre del fichero chat**
        //idUsuario comprador  _
        //idUsuario propietario  _
        //idArticulo                  _
        // ***estructura del nombre del fichero chat**

        $nombreFichero = $idUsuarioCompra
                . "_" . $idUsuarioPropietarioArticulo
                . "_" . $_SESSION["idArticulo"] . ".txt";

        $ficheroRuta = "log/" . $nombreFichero;

        //si no existe el fichero lo crea      
        if (!file_exists($ficheroRuta)) {
            ///crea el fichero
            $chatAritculo = $objChat->borraChatUsuarioCompraventa($idUsuarioCompra, $idUsuarioPropietarioArticulo, $_SESSION["idArticulo"]);
            $chatAritculo = $objChat->GragaChatUsuarioCompraventa($idUsuarioCompra, $idUsuarioPropietarioArticulo, $_SESSION["idArticulo"]);
            $ficheroActual = fopen($ficheroRuta, 'w');
        }

        $logFile = $ficheroRuta;

        //$time = date('H:i:s');
        //$data = "<p><strong>$time:</strong> $txtMensaje</p>\n";
        $time = date('H:i');
        $data = "<div class='divMensajeria'>"
                . "<label class='horaMensaje'>Henry $time:</label>"
                . "<label class='letraChat'>$txtMensaje</label>"
                . "</div>"
                . "\n";

        //escribe sobre el fichero
        file_put_contents($logFile, $data, FILE_APPEND);

      //  EnviarCorreo();
        
        //si el fichero existe, lee el contenido 
        if (file_exists($logFile)) {
            $readFichero = file_get_contents($logFile);
        } else {
            $readFichero = "<p>No hay mensajes aún.</p>";
        }

        //ajax
        $MensajeAlert = $readFichero;
        $response = compact('MensajeAlert');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
    }


    if (isset($_GET['action2']) == "btnRefrescar") {
        $idUsuarioCompra = 2;

        $MensajeAlert = "";
        $readFichero = "";
        $bexisteFichero = true;

        $idUsuarioPropietarioArticulo = "";
        $idUsuarioPropietarioArticulo = $consultas->BuscarUsuarioPropietarioArticulo($_SESSION["idArticulo"]);

        foreach ($idUsuarioPropietarioArticulo as $clave => $valor) {
            $idUsuarioPropietarioArticulo = $valor->idUsuario;
        }

        // ***estructura del nombre del fichero chat**
        //idUsuario comprador  _
        //idUsuario propietario  _
        //idArticulo                  _
        // ***estructura del nombre del fichero chat**

        $nombreFichero = $idUsuarioCompra
                . "_" . $idUsuarioPropietarioArticulo
                . "_" . $_SESSION["idArticulo"] . ".txt";

        $ficheroRuta = "log/" . $nombreFichero;

        //si no existe el fichero lo crea      
        if (!file_exists($ficheroRuta)) {
            ///crea el fichero
            $bexisteFichero = false;
        }

        if ($bexisteFichero) {
            //si el fichero existe, lee el contenido 
            if (file_exists($ficheroRuta)) {
                $readFichero = file_get_contents($ficheroRuta);
            } else {
                $readFichero = "<p> No hay mensajes aún.</p>";
            }
            $MensajeAlert = $readFichero;
        }


        //ajax

        $response = compact('MensajeAlert');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
    }
} else {



    //LOAD  
    $ListarEstadoArticulo = $consultas->ListarEstadoArticulo();
    $ListarCategoria = $consultas->ListarCategoria();
    $ListarTipoVenta = $consultas->ListarTipoVenta();

    MostrarImagenes();

    $htmlImagenes = $_SESSION['htmlImagenes'];

    $comprar = $_SESSION['Comprar'];
    $activarCompra = "";
    $chatVisible = "";
    $requiereChat = "";
    if ($comprar != null) {
        $activarCompra = "none";    // hay compra ocultamos los botones de modificacion
        $compraDeshabilitar = " disabled='true' ";
        $chatVisible = "auto";
        $requiereChat = "required='true'";
    } else {
        $activarCompra = "auto";    // visble botones de modificacion
        $compraDeshabilitar = "  ";
        $chatVisible = "none";
    }

    echo $blade->run('articulo',
            compact('titulo', 'descripcion', 'precio',
                    'estado', 'ubicacion',
                    'htmlImagenes', 'ListarEstadoArticulo',
                    'ListarCategoria', 'ListarTipoVenta', 'mensajeValidacion',
                    'ParametroListarEstadoArticulo',
                    'ParametroListarCategoria',
                    'ParametroListarTipoVenta',
                    'modificarfotos', 'requiredfoto', 'activarCompra', 'compraDeshabilitar', 'chatVisible', 'requiereChat'));
    die;
}

function BorrarFicherosFotos() {

    $host = '127.0.0.1';
    $user = 'root';
    $password = '';
    $dbname = 'bdproyectotfc';
    $conexion = new mysqli($host, $user, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $idArticulo = $_SESSION['idArticulo'];

    $sql = " SELECT descripcion FROM tbfotosarticulo where idarticulo=" . $idArticulo . " ";
    $resultado = $conexion->query($sql);

    $htmlImagenes = "";
    $primero = true;

    while ($fila = $resultado->fetch_assoc()) {
        if (file_exists("Fotos/" . $fila['descripcion'])) { //si el fichero existe se borra
            unlink("Fotos/" . $fila['descripcion']); //borramos los ficheros fisicos        
        }
    }
}

function GrabarImagen() {


    $host = '127.0.0.1';
    $user = 'root';
    $password = '';
    $dbname = 'bdproyectotfc';
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }



    if (!empty($_FILES['images']['name'][0])) {
        $imageCount = count($_FILES['images']['name']);

        $idArticulo = $_SESSION['idArticulo'];

        // Recorrer cada imagen
        for ($i = 0; $i < $imageCount; $i++) {
            $imageName = $_FILES['images']['name'][$i];
            $imageTmpName = $_FILES['images']['tmp_name'][$i];
            $imageSize = $_FILES['images']['size'][$i];
            $imageError = $_FILES['images']['error'][$i];
            $imageType = $_FILES['images']['type'][$i];

            // Extensiones permitidas
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            if (in_array($imageExt, $allowed)) {
                if ($imageError === 0) {
                    if ($imageSize < 5000000) { // Límite de 5MB
                        // Crear un nombre único para la imagen
                        //$imageNewName = uniqid('', true) . "." . $imageExt;
                        $imageNewName = $idArticulo . "_" . $i . "." . $imageExt;

                        //$imageDestination = 'uploads/' . $imageNewName;

                        $imageDestination = 'Fotos/' . $imageNewName;

                        // Mover la imagen a la carpeta "uploads"
                        if (move_uploaded_file($imageTmpName, $imageDestination)) {
                            // Insertar la ruta de la imagen en la base de datos
                            $sql = "      INSERT INTO tbfotosArticulo (idArticulo,descripcion) VALUES ('$idArticulo','$imageNewName') ";
                            if ($conn->query($sql) === TRUE) {
                                //  echo "Imagen subida y guardada: $imageNewName<br>";
                            } else {
                                echo "Error al guardar la imagen en la base de datos: " . $conn->error . "<br>";
                            }
                        } else {
                            echo "Error al mover el archivo $imageName<br>";
                        }
                    } else {
                        echo "El archivo $imageName es demasiado grande.<br>";
                    }
                } else {
                    echo "Hubo un error subiendo el archivo $imageName.<br>";
                }
            } else {
                echo "Tipo de archivo no permitido: $imageName<br>";
            }
        }
    }
}

function MostrarImagenes() {

    $host = '127.0.0.1';
    $user = 'root';
    $password = '';
    $dbname = 'bdproyectotfc';
    $conexion = new mysqli($host, $user, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $idArticulo = $_SESSION['idArticulo'];

    $sql = " SELECT descripcion FROM tbfotosarticulo where idarticulo=" . $idArticulo . " ";
    $resultado = $conexion->query($sql);

    $htmlImagenes = "";
    $primero = true;
    while ($fila = $resultado->fetch_assoc()) {
        $active_class = $primero ? 'active' : '';
        $htmlImagenes = $htmlImagenes . '<div style="transition:inherit" class="carousel-item ' . $active_class . '" >
                                   <img src="../Fotos/' . $fila['descripcion'] . '" class="img-fluid img-thumbnail" alt="Imagen" style="height: 500px">                                  
                                   </div>';
        $primero = false;
    }

    $_SESSION['htmlImagenes'] = $htmlImagenes;
}


function EnviarCorreo(){
    

//require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';  // Servidor SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'usuario@example.com'; // Usuario SMTP
    $mail->Password   = 'contraseña';         // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Cifrado SSL/TLS
    $mail->Port       = 465;                  // Puerto para SSL

    // Configuración del correo
    $mail->setFrom('proyectotrabajotfc@gmail.com', 'Nombre Remitente');
    $mail->addAddress('proyectotrabajotfc@gmail.com', 'Nombre Destinatario');
    $mail->Subject = 'Asunto del correo';
    $mail->Body    = 'Este es el cuerpo del correo.';
    $mail->AltBody = 'Este es el cuerpo alternativo del correo.';

    // Enviar correo
    $mail->send();
    echo "Correo enviado exitosamente.";
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}

}