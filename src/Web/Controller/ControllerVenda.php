<?php
IC::start(IC::$CONTROLLER);
require_once '../../Model/Evento.php';
require_once '../../Model/Participante.php';
require_once '../../Model/Venda.php';
require_once '../../Business/ManagerParticipante.php';
require_once '../../Business/ManagerEvento.php';
require_once '../../Business/ManagerVenda.php';
IC::end();

class ControllerVenda
{
    private $manager;
    private $managerEvento;
    private $managerParticipante;
    private $view;

    public function __construct()
    {
        $this->managerParticipante = new ManagerParticipante();
        $this->managerEvento = new ManagerEvento();
        $this->manager = new ManagerVenda();
        $this->view = new View();
    }

    public function actionLista($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        if (isset($param[0]))
        {
            $id = $param[0];

            $evento = $this->managerEvento->get($id, 'id', PDO::PARAM_STR)[0];

            if (!empty($evento))
            {
                $vendas = $this->manager->get($evento->getId(), 'evento_id', PDO::PARAM_INT, true);

                $this->view->addData('Vendas', $vendas);
                $this->view->addData('Evento', $evento);
                $this->view->call('lista', $this);
            }
            else
                Utils::e404();
        }
        else
            Utils::e404();
    }

    public function actionListaGeral($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        if (isset($param[0]))
        {
            $cidade = $param[0];

            $evento = $this->managerEvento->get($cidade, 'cidade', PDO::PARAM_STR);

            if (!empty($evento))
            {
                $vendas = array();
                foreach ($evento as $e)
                {
                    $result = $this->manager->get($e->getId(), 'evento_id', PDO::PARAM_INT, true);
                    foreach ($result as $v)
                    {
                        array_push($vendas, $v);
                    }
                }

                $this->view->addData('Cidade', $cidade);
                $this->view->addData('Vendas', $vendas);
                $this->view->addData('Evento', $evento);
                $this->view->addData('None', false);
            }
            else
            {
                $this->view->addData('Cidade', $cidade);
                $this->view->addData('None', true);
            }

            $this->view->call('listaGeral', $this);
        }
        else
            Utils::e404();
    }
}
