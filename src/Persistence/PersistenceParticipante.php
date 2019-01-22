<?php
IC::start(IC::$PERSISTENCE);
require_once "DataAccess.php";
require_once "DbConnection.php";
require_once "../Model/Participante.php";
IC::end();

class PersistenceParticipante implements DataAccess
{

    function insert($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "INSERT INTO participante VALUES (null,:nome,:cpf,:email,:ide)";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':nome', $objeto->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':cpf', $objeto->getCpf(), PDO::PARAM_STR);
        $statement->bindValue(':email', $objeto->getEmail(), PDO::PARAM_STR);
        $statement->bindValue(':ide', $objeto->getIde(), PDO::PARAM_STR);
        $statement->execute();

        $sqlString = "SELECT LAST_INSERT_ID()";
        $statement = $db->prepare($sqlString);
        $statement->execute();

        $result = $statement->fetch();

        DbConnection::disconnect();

        return $result[0];
    }

    function update($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "UPDATE participante SET nome = :nome, cpf = :cpf, email = :email, ide = :ide WHERE id = :id";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':id', $objeto->getId(), PDO::PARAM_INT);
        $statement->bindValue(':nome', $objeto->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':cpf', $objeto->getCpf(), PDO::PARAM_STR);
        $statement->bindValue(':email', $objeto->getEmail(), PDO::PARAM_STR);
        $statement->bindValue(':ide', $objeto->getIde(), PDO::PARAM_STR);
        $statement->execute();

        DbConnection::disconnect();
    }

    function delete($objeto)
    {
        // TODO: Implement delete() method.
    }

    function getAll()
    {
        // TODO: Implement getAll() method.
    }

    function getByField($key, $field, $param, $all)
    {
        $key = Utils::checkPdoParam($key,$param);

        $db = DbConnection::connect();

        $sqlString = "SELECT * FROM participante WHERE $field = :key";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':key', $key, $param);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $return = array();

        if ($results != false && !empty($results))
            foreach ($results as $participante)
                array_push($return, new Participante($participante['id'], $participante['nome'], $participante['cpf'], $participante['email'], $participante['ide']));
        else
            $results = null;

        DbConnection::disconnect();

        return $return;
    }
}