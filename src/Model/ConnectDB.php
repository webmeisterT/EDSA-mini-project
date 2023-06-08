<?php
namespace App\Model;
use \PDO;
use \PDOException;

class ConnectDB {
    // DB Params
    private string $host = "localhost";
    private string $user = "root";
    private string $dbname = "store";
    private string $password = "root";
    protected $conn;

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
}
