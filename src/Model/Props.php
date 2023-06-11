<?php
namespace App\Model;

trait Props {
    private string $table;
    private string $column;
    private string $where;
    private array $data;
    private string $value;

    public function getTable () {
        return $this->table;
    }
    public function setTable (string $tablename) {
        $this->table = $tablename;
    }

    public function getColumn () {
        return $this->column;
    }
    public function setColumn (string $columnname) {
        $this->column = $columnname;
    }

    public function getWhere () {
        return $this->where;
    }
    public function setWhere (string $wherename) {
        $this->where = $wherename;
    }

    public function getData () {
        return $this->data;
    }
    public function setData (array $dataname) {
        $this->data = $dataname;
    }

    public function getValue () {
        return $this->value;
    }
    public function setValue (string $valuename) {
        $this->value = $valuename;
    }

}