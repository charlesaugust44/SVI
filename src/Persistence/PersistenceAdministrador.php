<?php
IC::start(IC::$PERSISTENCE);
require_once "DataAccess.php";
require_once "DbConnection.php";
require_once "../Model/Administrador.php";
IC::end();

class PersistenceAdministrador implements DataAccess
{

    function insert($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "INSERT INTO administrador VALUES (null,:nome,:usuario,:senha,:isOrganizador,:cidade)";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':nome', $objeto->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':senha', $objeto->getSenha(), PDO::PARAM_STR);
        $statement->bindValue(':cidade', $objeto->getCidade(), PDO::PARAM_STR);
        $statement->bindValue(':usuario', $objeto->getUsuario(), PDO::PARAM_STR);
        $statement->bindValue(':isOrganizador', $objeto->isOrganizador(), PDO::PARAM_BOOL);
        $statement->execute();

        DbConnection::disconnect();
    }

    function update($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "UPDATE administrador SET nome = :nome,senha = :senha, cidade = :cidade WHERE id = :id";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':id', $objeto->getId(), PDO::PARAM_INT);
        $statement->bindValue(':nome', $objeto->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':senha', $objeto->getSenha(), PDO::PARAM_STR);
        $statement->bindValue(':cidade', $objeto->getCidade(), PDO::PARAM_STR);
        $statement->execute();

        DbConnection::disconnect();
    }

    function delete($id)
    {
        $id = intval($id);
        $db = DbConnection::connect();

        $sqlString = "DELETE FROM administrador WHERE id = :id";

        $statement = $db->prepare($sqlString);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();
        DbConnection::disconnect();
    }

    function getAll()
    {
        $db = DbConnection::connect();

        $sqlString = "SELECT * FROM administrador ORDER BY is_organizador ASC";

        $statement = $db->prepare($sqlString);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $return = array();

        if ($result != false && !empty($result))
            foreach ($result as $administrador)
                array_push($return, new Administrador($administrador['nome'], $administrador['usuario'], $administrador['senha'], $administrador['is_organizador'], $administrador['cidade'], $administrador['id']));
        else
            $return = null;

        DbConnection::disconnect();

        return $return;
    }

    function getByField($key, $field, $param, $all)
    {
        $key = Utils::checkPdoParam($key,$param);

        $db = DbConnection::connect();

        $sqlString = "SELECT * FROM administrador WHERE $field = :key";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':key', $key, $param);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $return = array();

        if ($results != false && !empty($results))
            foreach ($results as $administrador)
                array_push($return, new Administrador($administrador['nome'], $administrador['usuario'], $administrador['senha'], $administrador['is_organizador'], $administrador['cidade'], $administrador['id']));
        else
            $results = null;

        DbConnection::disconnect();

        return $return;
    }
}