<?php

class Router
{
    private $request;
    private $home = array("Evento", "Busca");
    private $login = array("Administrador", "Login");

    public function __construct($request)
    {
        $this->request = $request;
    }

    private function e404()
    {
        $uri = trim($this->request, "/");
        $uri = explode("/", $uri)[0];

        if ($uri == "404")
        {
            require_once "404.php";
            return true;
        }
        return false;
    }


    private function callController()
    {
        $uri = trim($this->request, "/");
        $uri = explode("/", $uri);
        switch ($uri[0])
        {
            case "":
                $uri = $this->home;
                break;
            case "Login":
            case "login":
            case "admin":
                $uri = $this->login;
        }

        $controller = "Controller" . $uri[0];
        $controllerPath = "Web/Controller/" . $controller . ".php";

        $action = "action" . $uri[1];

        if (file_exists($controllerPath))
        {
            require_once $controllerPath;
            $actions = get_class_methods($controller);

            if (in_array($action, $actions))
            {
                try
                {
                    $obj = new $controller;

                    $param = array();
                    for ($i = 2; $i < count($uri); $i++)
                        array_push($param, urldecode($uri[$i]));

                    $obj->{$action}($param);
                } catch (CredentialsException $e)
                {
                    header("HTTP/1.0 404 Not Found");
                    header('location: /Administrador/Login');
                }
            }
            else
                Utils::e404();
        }
        else
            Utils::e404();
    }

    private function callResource()
    {
        $uri = trim($this->request, "/");
        $extension = explode(".", $uri);
        $uri = explode("$", $uri);

        if ((count($extension) > 0) && (count($uri) >= 2))
        {
            $file = $GLOBALS['view'] . $uri[count($uri) - 1];

            if (file_exists($file))
            {
                switch ($extension[count($extension) - 1])
                {
                    case "js":
                        header("Content-Type: application/javascript");
                        break;
                    case "css":
                        header("Content-Type: text/css");
                        break;
                    case "woff":
                        header("Content-Type: application/font-woff");
                        break;
                    case "woff2":
                        header("Content-Type: application/font-woff2");
                        break;
                    case "ttf":
                        header("Content-Type: application/x-font-ttf");
                        break;
                    case "svg":
                        header("Content-Type: image/svg+xml");
                        break;
                    case "eot":
                        header("Content-Type: application/vnd.ms-fontobject");
                        break;
                }
                require_once $file;
            }
            else
                header("HTTP/1.0 404 Not Found");
            return true;
        }
        else
            return false;
    }

    public function call()
    {
        if (!$this->e404())
            if (!$this->callResource())
                $this->callController();
    }
}