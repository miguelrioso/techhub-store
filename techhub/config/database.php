<?php
class Database {
    private $host = "localhost";
    private $db_name = "techhub_store";
    private $username = "root";
    private $password = "";
    private $port = "3307"; // MUY IMPORTANTE en tu caso

    public function connect() {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}