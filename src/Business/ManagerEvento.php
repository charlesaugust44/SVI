<?php
IC::start(IC::$BUSINESS);
require_once '../Model/Evento.php';
require_once '../Persistence/PersistenceEvento.php';
IC::end();

class ManagerEvento
{
    private $persistence;

    public function __construct()
    {
        $this->persistence = new PersistenceEvento();
    }

    public function insert($evento)
    {
        $this->persistence->insert($evento);
    }

    public function update($evento)
    {
        $this->persistence->update($evento);
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