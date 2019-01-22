<?php

class Participante
{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $ide;

    /**
     * Participante constructor.
     * @param $id
     * @param $nome
     * @param $cpf
     * @param $email
     * @param $ide
     */
    public function __construct($id, $nome = null, $cpf = null, $email = null, $ide = null)
    {
        $this->id = intval($id);
        $this->nome = htmlspecialchars(addslashes($nome));
        $this->cpf = htmlspecialchars(addslashes($cpf));
        $this->email = htmlspecialchars(addslashes($email));
        $this->ide = htmlspecialchars(addslashes($ide));
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
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = htmlspecialchars(addslashes($cpf));
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = htmlspecialchars(addslashes($email));
    }

    /**
     * @return mixed
     */
    public function getIde()
    {
        return $this->ide;
    }

    /**
     * @param mixed $ide
     */
    public function setIde($ide)
    {
        $this->ide = htmlspecialchars(addslashes($ide));
    }

}
