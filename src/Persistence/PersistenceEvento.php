<?php
IC::start(IC::$PERSISTENCE);
require_once "DataAccess.php";
require_once "DbConnection.php";
require_once "../Model/Evento.php";
IC::end();

class PersistenceEvento implements DataAccess
{

    function insert($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "INSERT INTO evento VALUES (null, :titulo, :subtitulo, :categoria, :banner, :preco, :data_criacao, :data_inicio, :duracao, :hora_inicio, :hora_termino, :endereco, :descricao, :cidade)";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':titulo', $objeto->getTitulo(), PDO::PARAM_STR);
        $statement->bindValue(':subtitulo', $objeto->getSubtitulo(), PDO::PARAM_STR);
        $statement->bindValue(':categoria', $objeto->getCategoria(), PDO::PARAM_STR);
        $statement->bindValue(':banner', $objeto->getBanner(), PDO::PARAM_STR);
        $statement->bindValue(':preco', $objeto->getPreco());
        $statement->bindValue(':data_criacao', $objeto->getDataCriacao(), PDO::PARAM_STR);
        $statement->bindValue(':data_inicio', $objeto->getDataInicio(), PDO::PARAM_STR);
        $statement->bindValue(':duracao', $objeto->getDuracao(), PDO::PARAM_INT);
        $statement->bindValue(':hora_inicio', $objeto->getHoraInicio(), PDO::PARAM_STR);
        $statement->bindValue(':hora_termino', $objeto->getHoraTermino(), PDO::PARAM_STR);
        $statement->bindValue(':endereco', $objeto->getEndereco(), PDO::PARAM_STR);
        $statement->bindValue(':descricao', $objeto->getDescricao(), PDO::PARAM_STR);
        $statement->bindValue(':cidade', $objeto->getCidade(), PDO::PARAM_STR);
        $statement->execute();

        DbConnection::disconnect();
    }

    function update($objeto)
    {
        $db = DbConnection::connect();

        $sqlString = "UPDATE evento SET titulo = :titulo, subtitulo = :subtitulo, categoria = :categoria, banner = :banner, preco = :preco, data_criacao = :data_criacao, data_inicio = :data_inicio, duracao = :duracao, hora_inicio = :hora_inicio, hora_termino = :hora_termino, endereco = :endereco, descricao = :descricao, cidade = :cidade WHERE id = :id";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':id', $objeto->getId(), PDO::PARAM_INT);
        $statement->bindValue(':titulo', $objeto->getTitulo(), PDO::PARAM_STR);
        $statement->bindValue(':subtitulo', $objeto->getSubtitulo(), PDO::PARAM_STR);
        $statement->bindValue(':categoria', $objeto->getCategoria(), PDO::PARAM_STR);
        $statement->bindValue(':banner', $objeto->getBanner(), PDO::PARAM_STR);
        $statement->bindValue(':preco', $objeto->getPreco());
        $statement->bindValue(':data_criacao', $objeto->getDataCriacao(), PDO::PARAM_STR);
        $statement->bindValue(':data_inicio', $objeto->getDataInicio(), PDO::PARAM_STR);
        $statement->bindValue(':duracao', $objeto->getDuracao(), PDO::PARAM_INT);
        $statement->bindValue(':hora_inicio', $objeto->getHoraInicio(), PDO::PARAM_STR);
        $statement->bindValue(':hora_termino', $objeto->getHoraTermino(), PDO::PARAM_STR);
        $statement->bindValue(':endereco', $objeto->getEndereco(), PDO::PARAM_STR);
        $statement->bindValue(':descricao', $objeto->getDescricao(), PDO::PARAM_STR);
        $statement->bindValue(':cidade', $objeto->getCidade(), PDO::PARAM_STR);
        $statement->execute();

        DbConnection::disconnect();
    }

    function delete($id)
    {
        $id = intval($id);
        $db = DbConnection::connect();

        $sqlString = "DELETE FROM evento WHERE id = :id";

        $statement = $db->prepare($sqlString);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();
        DbConnection::disconnect();
    }

    function getAll()
    {
        $db = DbConnection::connect();

        $sqlString = "SELECT * FROM evento ORDER BY data_inicio ASC";

        $statement = $db->prepare($sqlString);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $return = array();

        if ($result != false && !empty($result))
            foreach ($result as $evento)
                array_push($return, new Evento($evento['id'], $evento['titulo'], $evento['subtitulo'], $evento['categoria'], $evento['banner'], $evento['preco'], $evento['data_criacao'], $evento['data_inicio'], $evento['duracao'], $evento['hora_inicio'], $evento['hora_termino'], $evento['endereco'], $evento['descricao'], $evento['cidade']));
        else
            $return = null;

        DbConnection::disconnect();

        return $return;
    }

    function getByField($key, $field, $param, $all)
    {
        $key = Utils::checkPdoParam($key,$param);

        $db = DbConnection::connect();

        if ($all)
            $sqlString = "SELECT * FROM evento e INNER JOIN venda v ON e.id = v.evento_id WHERE e.$field = :key ORDER BY e.data_inicio DESC";
        else
            $sqlString = "SELECT * FROM evento WHERE $field = :key ORDER BY data_inicio ASC";

        $statement = $db->prepare($sqlString);

        $statement->bindValue(':key', $key, $param);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $return = array();

        if ($results != false && !empty($results))
        {
            for ($i = 0; $i < count($results); $i++)
            {
                $r = $results[$i];
                $vendas = array();

                if ($all)
                {
                    while (isset($results[$i]) && ($r['evento_id'] == $results[$i]['evento_id']))
                    {
                        array_push($vendas, new Venda($r['id'], $r['data_venda'], $r['data_confirmacao'], $r['evento_id'], $r['pulseira'], $r['participante_id']));
                        $i++;
                    }
                    $i--;
                }

                array_push($return, new Evento($r['id'], $r['titulo'], $r['subtitulo'], $r['categoria'], $r['banner'], $r['preco'], $r['data_criacao'], $r['data_inicio'], $r['duracao'], $r['hora_inicio'], $r['hora_termino'], $r['endereco'], $r['descricao'], $r['cidade'], $vendas));
            }
        }
        else
            $results = null;

        DbConnection::disconnect();

        return $return;
    }
}