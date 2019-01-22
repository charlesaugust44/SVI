<?php
IC::start(IC::$PERSISTENCE);
require_once "DataAccess.php";
require_once "DbConnection.php";
require_once "../Model/Venda.php";
require_once "../Model/Evento.php";
require_once "../Model/Participante.php";
IC::end();

class PersistenceVenda implements DataAccess
{

    function insert($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "INSERT INTO venda VALUES (null,:data_venda,:data_confirmacao,:evento_id,:pulseira,:participante_id, :checkin)";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':data_venda', $objeto->getDataVenda(), PDO::PARAM_STR);
        $statement->bindValue(':data_confirmacao', $objeto->getDataConfirmacao(), PDO::PARAM_STR);
        $statement->bindValue(':pulseira', $objeto->getPulseira(), PDO::PARAM_STR);
        $statement->bindValue(':evento_id', $objeto->getEventoId(), PDO::PARAM_INT);
        $statement->bindValue(':participante_id', $objeto->getParticipante()->getId(), PDO::PARAM_INT);
        $statement->bindValue(':checkin', $objeto->getCheckin(), PDO::PARAM_INT);
        $statement->execute();

        DbConnection::disconnect();
    }

    function update($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "UPDATE venda SET data_venda = :data_venda, data_confirmacao = :data_confirmacao, evento_id = :evento_id, pulseira = :pulseira,participante_id = :participante_id,checkin = :checkin WHERE id = :id";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':id', $objeto->getId(), PDO::PARAM_INT);
        $statement->bindValue(':data_venda', $objeto->getDataVenda(), PDO::PARAM_STR);
        $statement->bindValue(':data_confirmacao', $objeto->getDataConfirmacao(), PDO::PARAM_STR);
        $statement->bindValue(':pulseira', $objeto->getPulseira(), PDO::PARAM_STR);
        $statement->bindValue(':evento_id', $objeto->getEventoId(), PDO::PARAM_INT);
        $statement->bindValue(':participante_id', $objeto->getParticipante()->getId(), PDO::PARAM_INT);
        $statement->bindValue(':checkin', $objeto->getCheckin(), PDO::PARAM_INT);
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

        if ($all)
            $sqlString = "SELECT * FROM venda v INNER JOIN participante p ON v.participante_id = p.id WHERE v.$field = :key ORDER BY v.data_venda DESC";
        else
            $sqlString = "SELECT * FROM venda WHERE $field = :key";


        $statement = $db->prepare($sqlString);
        $statement->bindValue(':key', $key, $param);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $return = array();

        if ($results != false && !empty($results))
        {
            foreach ($results as $r)
            {
                $participante = new Participante($r['participante_id']);

                if ($all)
                    $participante = new Participante($r['participante_id'], $r['nome'], $r['cpf'], $r['email'], $r['ide']);

                array_push($return, new Venda($r['id'], $r['data_venda'], $r['data_confirmacao'], $r['pulseira'], $participante, $r['evento_id'],$r['checkin']));
            }
        }
        else
            $results = null;

        DbConnection::disconnect();

        return $return;
    }
}