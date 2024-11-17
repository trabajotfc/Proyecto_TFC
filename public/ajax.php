<?php
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'bdproyectotfc');
 
$connexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
 
$html = '';
$key = $_POST['key'];
 
$result = $connexion->query(' SELECT idarticulo,titulo FROM TBARTICULO WHERE TITULO  LIKE "%'.strip_tags($key).'%"  ');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<div><a class="suggest-element" data="'.utf8_encode($row['titulo']).'" id="product'.$row['idarticulo'].'">'.utf8_encode($row['titulo']).'</a></div>';
    }
}
echo $html;
?>