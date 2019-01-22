<?php
IC::start(IC::$BUSINESS);
require_once '../Model/Venda.php';
require_once '../Persistence/PersistenceVenda.php';
IC::end();

class ManagerVenda
{
    public static $ALL = 3;
    public static $PARTICIPANTE = 2;
    public static $EVENTO = 1;

    private $persistence;

    public function __construct()
    {
        $this->persistence = new PersistenceVenda();
    }

    public function insert($venda)
    {
        $this->persistence->insert($venda);
    }

    public function update($venda)
    {
        $this->persistence->update($venda);
    }

    public function delete($id)
    {
        $this->persistence->delete($id);
    }

    public function getAll()
    {
        return $this->persistence->getAll();
    }

    public function get($key, $field = 'id', $param = 1, $all = false)
    {
        return $this->persistence->getByField($key, $field, $param, $all);
    }
}
