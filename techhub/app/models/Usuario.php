<?php
require_once __DIR__ . "/../../config/database.php";

class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrar($nombre, $email, $password) {
        $query = "INSERT INTO " . $this->table . " (nombre, email, password)
                  VALUES (:nombre, :email, :password)";

        $stmt = $this->conn->prepare($query);

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hash);

        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }

        return false;
    }
}