<?php
namespace App\Model;

use App\Model\ConnectDB;
use App\Model\Props;

class ReadRecord extends ConnectDB {
    use Props;
    // Select all records from the table
    public function readRecord()
    {
        $query = "SELECT $this->column FROM $this->table WHERE $this->where";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($this->data);
        return $stmt->fetchAll();
    }

    // Select One record from the table
    public function readOneRecord()
    {
        $query = "SELECT $this->column FROM $this->table WHERE $this->where";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($this->data);
        return $stmt->fetch();
    }

    // Select all records from joint table
    public function joinRecords(string $id1, string $id2, string $table2)
    {
        $query = "SELECT $this->column FROM $this->table t1 INNER JOIN $table2 t2 ON t1.$id1=t2.$id2 WHERE $this->where ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($this->data);
        return $stmt->fetchAll();
    }

}
