<?php

class Administrador
{
    private $id;
    private $nome;
    private $usuario;
    private $senha;
    private $isOrganizador;
    private $cidade;

    /**
     * Administrador constructor.
     * @param $id
     * @param $nome
     * @param $usuario
     * @param $senha
     * @param $isOrganizador
     * @param $cidade
     */
    public function __construct($nome = null, $usuario = null, $senha = null, $isOrganizador = null, $cidade = null, $id = null)
    {
        $this->id = intval($id);
        $this->nome = htmlspecialchars(addslashes($nome));
        $this->usuario = htmlspecialchars(addslashes($usuario));
        $this->senha = $senha;
        $this->isOrganizador = $isOrganizador;
        $this->cidade = htmlspecialchars(addslashes($cidade));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = intval($id);
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = htmlspecialchars(addslashes($nome));
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = htmlspecialchars(addslashes($usuario));
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function isOrganizador()
    {
        return $this->isOrganizador;
    }

    /**
     * @param mixed $isOrganizador
     */
    public function setOrganizador()
    {
        $this->isOrganizador = true;
    }

    public function unsetOrganizador()
    {
        $this->isOrganizador = false;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = htmlspecialchars(addslashes($cidade));
    }

}
