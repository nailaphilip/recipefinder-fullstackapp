<?php
// $host = 'db1';
// $dbname = 'recipes';
// $user = 'root';
// $password = 'lionPass';

// $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


class DbConnect {
    private $server = 'db1';
    private $dbname = 'recipes';
    private $user = 'root';
    private $pass = 'lionPass';
    public function connect() {
    try {
    $conn = new PDO('mysql:host=' .$this->server.';dbname=' . $this->dbname, $this->user, $this->pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
    } catch (\Exception $e) {
    echo "Database Error: " . $e->getMessage();
    }
    }
    }
?>