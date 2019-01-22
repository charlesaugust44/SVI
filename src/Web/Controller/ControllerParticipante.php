<?php
IC::start(IC::$CONTROLLER);
require_once '../../Model/Evento.php';
require_once '../../Model/Participante.php';
require_once '../../Model/Venda.php';
require_once '../../Business/ManagerParticipante.php';
require_once '../../Business/ManagerEvento.php';
require_once '../../Business/ManagerVenda.php';
IC::end();

class ControllerParticipante
{
    private $manager;
    private $managerEvento;
    private $managerVenda;
    private $view;
    //private $mp;

    public function __construct()
    {
        $this->managerVenda = new ManagerVenda();
        $this->managerEvento = new ManagerEvento();
        $this->manager = new ManagerParticipante();
        $this->view = new View();
        //$this->mp = new MP("2223636266870432","I9ag1pELpWtqVY8akDh2L2Ok524w7H7C");
    }

    public function actionChecar($param)
    {
        if (isset($param[0]))
        {
            $id = $param[0];

            $evento = $this->managerEvento->get($id)[0];

            if (!empty($evento))
            {
                if (isset($param[1]))
                    $this->view->addData('isCadastrado', true);
                $this->view->addData('Evento', $evento);
                $this->view->call('inscricaoCpf', $this);
            }
            else
                Utils::e404();
        }
        else
            Utils::e404();
    }

    public function actionInscricao($param)
    {
        if (isset($param[0]))
        {
            $id = $param[0];
            $cpf = $_POST['cpf'];

            $evento = $this->managerEvento->get($id)[0];

            if (!empty($evento))
            {
                $participante = $this->manager->get($cpf, 'cpf', PDO::PARAM_STR);
                if (!empty($participante))
                    $venda = $this->managerVenda->get($participante[0]->getId(), 'participante_id', PDO::PARAM_STR)[0];

                if (empty($venda))
                {
                    $this->view->addData('cpf', $cpf);
                    $this->view->addData('Participante', $participante);
                    $this->view->addData('Evento', $evento);
                    $this->view->call('inscricao', $this);
                }
                else
                {
                    header('location: /Participante/Checar/' . $evento->getId() . '/isCadastrado');
                }
            }
            else
                Utils::e404();
        }
        else
            Utils::e404();
    }

    public function actionInscrever($param)
    {
        if (isset($param[0]))
        {
            $id = $param[0];

            $evento = $this->managerEvento->get($id)[0];

            if (!empty($evento))
            {
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $email = $_POST['email'];
                $pulseira = $_POST['pulseira'];

                $participanteNovo = new Participante(null, $nome, $cpf, $email, null);

                $participante = @$this->manager->get($cpf, 'cpf', PDO::PARAM_STR)[0];

                if (empty($participante))
                {
                    $idp = $this->manager->insert($participanteNovo);
                    $participanteNovo->setId($idp);
                }
                else
                {
                    $participanteNovo->setId($participante->getId());
                    $this->manager->update($participanteNovo);
                }

                $venda = new Venda(null, date('Y-m-d H:i:s'), null, $pulseira, $participanteNovo, $evento->getId());

                $this->managerVenda->insert($venda);

                header('location: /Evento/Detalhe/' . $id . '/success');
            }
            else
                Utils::e404();
        }
        else
            Utils::e404();
    }

    public function actionShowCheckin($param)
    {
        Auth::sessionCheck();

        if (isset($param[0]))
        {
            $id = $param[0];

            $evento = $this->managerEvento->get($id, 'id', PDO::PARAM_STR)[0];

            if (!empty($evento))
            {
                $vendas = $this->managerVenda->get($evento->getId(), 'data_confirmacao IS NOT NULL AND evento_id', PDO::PARAM_INT, true);

                $this->view->addData('Vendas', $vendas);
                $this->view->addData('Evento', $evento);
                $this->view->call('checkin', $this);
            }
            else
                Utils::e404();
        }
        else
            Utils::e404();
    }

    public function actionCheckin($param)
    {
        Auth::sessionCheck();

        if (isset($param[0]))
        {
            $id = $param[0];
            $idv = $_POST['venda'];

            $evento = $this->managerEvento->get($id)[0];
            $venda = $this->managerVenda->get($idv)[0];

            if (!empty($evento) && !empty($venda))
            {
                $f = $venda->getCheckin();
                $venda->setCheckin(($f) ? false : true);
                $this->managerVenda->update($venda);
                echo "true";
            }
            else
                header('HTTP/1.0 404 not found');
        }
        else
            header('HTTP/1.0 404 not found');
    }
}
