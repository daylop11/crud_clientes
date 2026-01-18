<?php
class Cliente {
    public $id;
    public $nombre;
    public $correo;
    public $telefono;

    private $conn;
    private $table = "clientes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $sql = "INSERT INTO {$this->table}(nombre, correo, telefono)
                VALUES(:nombre, :correo, :telefono)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":nombre" => $this->nombre,
            ":correo" => $this->correo,
            ":telefono" => $this->telefono
        ]);
    }

    public function listar() {
        return $this->conn->query("SELECT * FROM {$this->table}");
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id=:id");
        $stmt->execute([":id"=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $sql = "UPDATE {$this->table}
                SET nombre=:nombre, correo=:correo, telefono=:telefono
                WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":id"=>$this->id,
            ":nombre"=>$this->nombre,
            ":correo"=>$this->correo,
            ":telefono"=>$this->telefono
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=:id");
        return $stmt->execute([":id"=>$id]);
    }
}