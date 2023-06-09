<?php
namespace App\Model;

use App\Model\ConnectDB;
use App\Model\Props;

class CreateRecord extends ConnectDB{
    use Props;
    // Create a record in the table
    public function create()
    {
        $query = "INSERT INTO $this->table($this->column) VALUES ($this->value) ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($this->data);
    }

}
