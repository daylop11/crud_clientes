<?php
$data = file_get_contents("http://localhost/crud_clientes/controllers/ClienteController.php");
$clientes = json_decode($data, true);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#eef2f7;
            padding:40px;
        }
        h2{
            text-align:center;
            color:#2c3e50;
        }
        table{
            width:85%;
            margin:auto;
            border-collapse:collapse;
            background:white;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }
        th,td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }
        th{
            background:#34495e;
            color:white;
        }
        tr:hover{
            background:#f5f5f5;
        }
    </style>
</head>
<body>

<h2>📋 Lista de Clientes</h2>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Teléfono</th>
</tr>

<?php foreach($clientes as $c): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= $c['nombre'] ?></td>
    <td><?= $c['correo'] ?></td>
    <td><?= $c['telefono'] ?></td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>
