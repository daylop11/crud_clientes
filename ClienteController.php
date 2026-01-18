<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$db   = "crud_clientes";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexion"]); 
    exit;
}

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {

    // GET → Listar clientes
    case "GET":
        $result = $conn->query("SELECT * FROM clientes");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    // POST → Insertar cliente
    case "POST":
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            echo json_encode(["error" => "No se recibieron datos"]);
            break;
        }

        $nombre   = $input["nombre"] ?? "";
        $correo   = $input["correo"] ?? "";
        $telefono = $input["telefono"] ?? "";

        $sql = "INSERT INTO clientes (nombre, correo, telefono)
                VALUES ('$nombre','$correo','$telefono')";

        if ($conn->query($sql)) {
            echo json_encode(["mensaje" => "Cliente creado correctamente"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    // PUT → Actualizar cliente
    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);

        $id       = $input["Id"] ?? 0;
        $nombre   = $input["Nombre"] ?? "";
        $correo   = $input["Correo"] ?? "";
        $telefono = $input["Telefono"] ?? "";

        $sql = "UPDATE clientes 
                SET nombre='$nombre', correo='$correo', telefono='$telefono'
                WHERE id=$id";

        if ($conn->query($sql)) {
            echo json_encode(["mensaje" => "Cliente actualizado"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    // DELETE → Eliminar cliente
    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        $id = $data["id"] ?? 0;

        $sql = "DELETE FROM clientes WHERE id=$id";

        if ($conn->query($sql)) {
            echo json_encode(["mensaje" => "Cliente eliminado"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    default:
        echo json_encode(["error" => "Metodo no permitido"]);
}

$conn->close();
