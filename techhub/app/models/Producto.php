<?php
require_once __DIR__ . "/../../config/database.php";

class Producto {
    private $conn;
    private $table = "productos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenerProductos() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}