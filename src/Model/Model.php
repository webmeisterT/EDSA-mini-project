<?php
Class Model {
    // DB Params
    private string $host = "localhost";
    private string $user = "root";
    private string $dbname = "store";
    private string $password = "root";
    private $conn;

    // DB Connect
    public function __construct ()
    {
        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // DEFAULT MODES
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } 
        catch (PDOException $th) {
            // return "Connection Error: ". $th->getMessage();
            echo "Connection Error: ". $th->getMessage();
        }
    }

    // Select all records from the table
    public function read(string $table, string $column = "*", $where = "1", array $data = [])
    {
        $query = "SELECT $column FROM $table WHERE $where";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }
    
    // Select One record from the table
    public function readOne(string $table, string $column = "*", string $where = "1", array $data = [])
    {
        $query = "SELECT $column FROM $table WHERE $where";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->fetch();
    }

    // Create a record in the table
    public function create(string $table, string $column, string $value, array $data = [])
    {
        $query = "INSERT INTO $table($column) VALUES ($value) ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

public function sanitize(string $var)
{
    return htmlspecialchars(stripslashes(trim($var)));
}


public function mustBeLoggedIn()
{
    if (!isset($_SESSION['is_logged_in'])) {
        $_SESSION['error'] = "Please login to continue!";
        return header('location: login.php');
    }
}
}
