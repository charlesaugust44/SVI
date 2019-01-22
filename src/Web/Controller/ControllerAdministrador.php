<?php
IC::start(IC::$CONTROLLER);
require_once '../../Model/Administrador.php';
require_once '../../Business/ManagerAdministrador.php';
IC::end();

class ControllerAdministrador
{
    private $manager;
    private $view;

    public function __construct()
    {
        $this->manager = new ManagerAdministrador();
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

            $administrador = $this->manager->get($id)[0];

            if ($administrador == null)
                Utils::e404();
            else
            {
                $this->view->addData('Administrador', $administrador);
                $this->view->addData('SenhaErrada', false);
                $this->view->call('form_edt', $this);
            }
        }
        else
            Utils::e404();
    }

    public function actionLista($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        $administradores = $this->manager->getAll();

        $this->view->addData('Administradores', $administradores);
        $this->view->call('lista', $this);
    }

    public function actionCadastrar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = Utils::encrypt($_POST['senha']);
        $isOrganizador = isset($_POST['isOrganizador']);
        $cidade = $_POST['cidade'];

        $administrador = null;

        if ($isOrganizador)
            $administrador = new Administrador($nome, $usuario, $senha, $isOrganizador, $cidade);
        else
            $administrador = new Administrador($nome, $usuario, $senha, $isOrganizador);

        $this->manager->insert($administrador);

        header("location: /Administrador/ShowCadastrar");
    }

    public function actionEditar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        if (isset($param[0]))
        {
            $id = $param[0];
            $nome = $_POST['nome'];
            $senhaOld = $_POST['senhaOld'];
            $senhaNew = $_POST['senhaNew'];
            $cidade = null;

            if (isset($_POST['cidade']))
                $cidade = $_POST['cidade'];

            $administrador = $this->manager->get($id)[0];

            if ($administrador == null)
                Utils::e404();
            else
            {
                $this->view->addData('SenhaErrada', false);

                if ($senhaOld == null)
                {
                    $administrador->setNome($nome);
                    $administrador->setCidade($cidade);

                    $this->manager->update($administrador);
                    header("location: /Administrador/Lista");
                }
                else if ($administrador->getSenha() == Utils::encrypt($senhaOld))
                {
                    $administrador->setNome($nome);
                    $administrador->setSenha(Utils::encrypt($senhaNew));
                    $administrador->setCidade($cidade);

                    $this->manager->update($administrador);

                    header("location: /Administrador/Lista");
                }
                else
                {
                    $administrador->setNome($nome);
                    $administrador->setCidade($cidade);

                    $this->view->addData('Administrador', $administrador);
                    $this->view->addData('SenhaErrada', true);
                    $this->view->call('form_edt', $this, $administrador);
                }
            }
        }
        else
            Utils::e404();
    }

    public function actionDeletar($param)
    {
        Auth::sessionCheck(Auth::$LVL2);
        $id = $param[0];

        $administrador = $this->manager->get($id)[0];

        if ($administrador != null)
        {
            $this->manager->delete($id);
            header("location: /Administrador/Lista");
        }
        else
            Utils::e404();
    }

    public function actionLogin($param)
    {
        $this->view->call('login', $this);
    }

    public function actionAuthenticate($param)
    {
        if ((isset($_POST['usuario'])) && ($_POST['senha']))
        {
            $user = $_POST['usuario'];
            $pass = $_POST['senha'];

            $result = $this->manager->checkUserPass($user, $pass);

            if ($result != null)
            {
                $level = Auth::$LVL1;
                $path = '/Evento/Lista/Aracaju';
                if (!$result->isOrganizador())
                    $level = Auth::$LVL2;

                Auth::createSession($level,$result->getNome(),$result->getId());
                header('location: ' . $path);
            }
            else
            {
                header('location: /Administrador/Login/Error');
            }
        }
        else
            header('location: /Administrador/Login/Error');
    }

    public function actionLogout($param)
    {
        Auth::sessionCheck();
        Auth::destroySession();
        header('location: /Login');
    }
}
