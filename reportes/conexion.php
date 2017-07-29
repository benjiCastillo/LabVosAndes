<?php
function Conectar () {
    $conn = null;
    $host = 'localhost';
    $db = 'vos_andes';
    $user = 'root';
    $pwd = '';
    try{
        $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
    }catch (PDOException $e) {
        echo '<p>No se puede conectar a la base de datos!</p>';
        exit;
    }
    return $conn;
}

?>