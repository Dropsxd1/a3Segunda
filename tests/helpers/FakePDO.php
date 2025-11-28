<?php

// Fake PDO e Statement para testar DAO sem atingir banco real.
class FakePDO
{
    public $data;
    public $captured = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepare($sql)
    {
        return new FakeStatement($this, $sql);
    }
}

class FakeStatement
{
    private $pdo;
    private $sql;
    private $result = [];

    public function __construct(FakePDO $pdo, $sql)
    {
        $this->pdo = $pdo;
        $this->sql = $sql;
    }

    public function execute($params = null)
    {
        // SELECT: retorna dados filtrando por id quando existe WHERE.
        if (stripos($this->sql, 'SELECT') === 0) {
            if (strpos($this->sql, 'WHERE id') !== false && $params) {
                $id = $params[0];
                foreach ($this->pdo->data as $row) {
                    if ((int)$row['id'] === (int)$id) {
                        $this->result = $row;
                        break;
                    }
                }
            } else {
                $this->result = $this->pdo->data;
            }
            return true;
        }

        // INSERT/UPDATE/DELETE: apenas registra SQL e params.
        $this->pdo->captured[] = ['sql' => $this->sql, 'params' => $params];
        return true;
    }

    public function fetchAll($mode = null)
    {
        return is_array($this->result) && isset($this->result[0])
            ? $this->result
            : $this->result;
    }

    public function fetch($mode = null)
    {
        if (is_array($this->result) && array_keys($this->result) !== range(0, count($this->result) - 1)) {
            return $this->result;
        }

        if (is_array($this->result) && count($this->result) > 0) {
            return $this->result[0];
        }

        return false;
    }
}
