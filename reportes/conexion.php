<?php
function conectar (){
    $conn = null;
    $host = '127.0.0.1';
    $db = 'vos_andes';
    $user = 'root';
    $pwd = '';
    try{
        $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
        echo 'Conexion satisfactoria.<br>';
    } catch (PDOExeption $e) {
        echo '<p>No se puede conectar a la base de datos</p>';
        exit;
    }
    return $conn;
}
?>