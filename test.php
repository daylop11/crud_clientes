<?php
require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

if($conn){
    echo "Conectado correctamente a la base de datos";
}