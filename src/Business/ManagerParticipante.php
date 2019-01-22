<?php
IC::start(IC::$BUSINESS);
require_once '../Model/Participante.php';
require_once '../Persistence/PersistenceParticipante.php';
IC::end();

class ManagerParticipante
{
    private $persistence;

    public function __construct()
    {
        $this->persistence = new PersistenceParticipante();
    }

    public function insert($participante)
    {
        return $this->persistence->insert($participante);
    }

    public function update($participante)
    {
        $this->persistence->update($participante);
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