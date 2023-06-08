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
    public function setTable ($tablename) {
        $this->table = $tablename;
    }

    public function getColumn () {
        return $this->column;
    }
    public function setColumn ($columnname) {
        $this->column = $columnname;
    }

    public function getWhere () {
        return $this->where;
    }
    public function setWhere ($wherename) {
        $this->where = $wherename;
    }

    public function getData () {
        return $this->data;
    }
    public function setData ($dataname) {
        $this->data = $dataname;
    }

    public function getValue () {
        return $this->value;
    }
    public function setValue ($valuename) {
        $this->value = $valuename;
    }

}