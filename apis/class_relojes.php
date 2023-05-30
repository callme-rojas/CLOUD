<?php
class Relojes {
    private $conn;
    private $table_name = "relojes";

    public $id;
    public $nombre;
    public $marca;
    public $precio;
    public $material;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, marca=:marca, precio=:precio, material=:material";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->material = htmlspecialchars(strip_tags($this->material));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":material", $this->material);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, marca=:marca, precio=:precio, material=:material WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->material = htmlspecialchars(strip_tags($this->material));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":material", $this->material);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
