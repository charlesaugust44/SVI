<?php
IC::start(IC::$BUSINESS);
require_once '../Model/Administrador.php';
require_once '../Persistence/PersistenceAdministrador.php';
IC::end();

class ManagerAdministrador
{
    private $persistence;

    public function __construct()
    {
        $this->persistence = new PersistenceAdministrador();
    }

    public function insert($administrador)
    {
        $this->persistence->insert($administrador);
    }

    public function update($administrador)
    {
        $this->persistence->update($administrador);
    }

    public function delete($id)
    {
        $this->persistence->delete($id);
    }

    public function getAll()
    {
        return $this->persistence->getAll();
    }

    public function getAllOrganizadores()
    {
        return $this->get(true, 'is_organizador', PDO::PARAM_INT);
    }

    public function checkUserPass($user, $pass)
    {
        $admin = $this->get($user, 'usuario', PDO::PARAM_STR)[0];

        if (($admin != null) && ($admin->getSenha() == Utils::encrypt($pass)))
            return $admin;

        return null;
    }

    public function get($key, $field = 'id', $param = 1, $all = false)
    {
        return $this->persistence->getByField($key, $field, $param, $all);
    }
}