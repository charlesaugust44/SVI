<?php
IC::start(IC::$CONTROLLER);
require_once '../../Model/Evento.php';
require_once '../../Model/Administrador.php';
require_once '../../Business/ManagerAdministrador.php';
require_once '../../Business/ManagerEvento.php';
IC::end();

class ControllerEvento
{
    private $manager;
    private $view;

    public function __construct()
    {
        $this->manager = new ManagerEvento();
        $this->view = new View();
    }

    public function actionShowCadastrar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        $this->view->call('form_cad', $this);
    }

    public function actionShowEditar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);

        if (isset($param[0]))
        {
            $id = $param[0];

            $evento = $this->manager->get($id)[0];

            if ($evento == null)
                Utils::e404();
            else
            {
                $this->view->addData('Evento', $evento);
                $this->view->call('form_edt', $this);
            }
        }
        else
            Utils::e404();
    }

    public function actionBusca($param)
    {
        $cidade = "Aracaju";

        if (isset($param[0]))
            $cidade = $param[0];

        $eventos = $this->manager->get($cidade, 'cidade', PDO::PARAM_STR);

        $result = array();

        foreach ($eventos as $e)
        {
            $data = $e->getDataInicio() . "23:59:59";
            $data = new DateTime($data);
            $data = date_sub($data, date_interval_create_from_date_string('1 days'));
            if ((new DateTime())->getTimestamp() <= $data->getTimestamp())
                array_push($result, $e);
        }

        $this->view->addData('Eventos', $result);
        $this->view->addData('Cidade', $cidade);
        $this->view->call('busca', $this);
    }

    public function actionDetalhe($param)
    {
        if (isset($param[0]))
        {
            $evento = $this->manager->get($param[0]);

            if (isset($param[1]))
                $this->view->addData('success', true);
            $this->view->addData('Evento', $evento[0]);
            $this->view->call('detalhe', $this);
        }
        else
            Utils::e404();
    }

    public function actionLista($param)
    {
        Auth::sessionCheck();

        $user = (new ManagerAdministrador())->get(Auth::getId())[0];

        if (!empty($user))
        {
            if ($user->isOrganizador())
                $cidade = $user->getCidade();
            else
                $cidade = $param[0];
            $evento = $this->manager->get($cidade, 'cidade', PDO::PARAM_STR);

            if (!empty($evento))
                $this->view->addData('Eventos', $evento);
            else
                $this->view->addData('Eventos', array());

            $this->view->addData('Cidade', $cidade);
            $this->view->call('lista', $this);
        }
        else
            header('location: /Administrador/Logout');

    }

    public function actionCadastrar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);

        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $categoria = $_POST['categoria'];
        $preco = $_POST['preco'];
        $data = $_POST['data'];
        $duracao = $_POST['duracao'];
        $hora_incio = $_POST['horaInicio'];
        $hora_termino = $_POST['horaTermino'];
        $cidade = $_POST['cidade'];
        $endereco = $_POST['endereco'];
        $descricao = $_POST['descricao'];

        $file = Utils::upload("evento");

        if ($file[0])
        {
            $evento = new Evento(null, $titulo, $subtitulo, $categoria, $file[1], $preco, date("Y-m-d H:i:s"), $data, $duracao, $hora_incio, $hora_termino, $endereco, $descricao, $cidade);

            $this->manager->insert($evento);

            header("location: /Evento/ShowCadastrar");
        }
        else
        {
            header("location: /Evento/ShowCadastrar/" . $file[1]);
        }
    }

    public function actionEditar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);

        if (isset($param[0]))
        {
            $id = $param[0];

            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'];
            $categoria = $_POST['categoria'];
            $preco = $_POST['preco'];
            $data = $_POST['data'];
            $duracao = $_POST['duracao'];
            $hora_incio = $_POST['horaInicio'];
            $hora_termino = $_POST['horaTermino'];
            $cidade = $_POST['cidade'];
            $endereco = $_POST['endereco'];
            $descricao = $_POST['descricao'];

            $filename = null;

            $file = Utils::upload("evento");

            $old = $this->manager->get($id)[0];

            if ($file[0])
            {
                $filename = $file[1];
                unlink($GLOBALS['view'] . "inc/images/" . $old->getBanner());
            }
            else if ($file[1] == "noFile")
            {
                $filename = $old->getBanner();
            }
            else
                header("location: /Evento/ShowEditar/" . $id . "/" . $file[1]);

            if (($file[0]) || ($file[1] == "noFile"))
            {
                $evento = new Evento($id, $titulo, $subtitulo, $categoria, $filename, $preco, date("Y-m-d H:i:s"), $data, $duracao, $hora_incio, $hora_termino, $endereco, $descricao, $cidade);

                $this->manager->update($evento);

                header("location: /Evento/Lista/$cidade");
            }
        }
        else
            Utils::e404();
    }

    public function actionDeletar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);

        $id = $param[0];

        $evento = $this->manager->get($id)[0];

        if ($evento != null)
        {
            unlink($GLOBALS['view'] . "inc/images/" . $evento->getBanner());
            $this->manager->delete($id);
            header('location: /Evento/Lista/' . $evento->getCidade());
        }
        else
            Utils::e404();
    }
}
