
<?php
require_once 'config.php';

class Database {
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
                'error' => 'Error de conexión a la base de datos',
                'detalle' => $e->getMessage()
            ]);
            exit;
        }
    }
}
?>