<?php

class Evento
{
    private $id;
    private $titulo;
    private $subtitulo;
    private $categoria;
    private $banner;
    private $preco;
    private $data_criacao;
    private $data_inicio;
    private $duracao;
    private $hora_inicio;
    private $hora_termino;
    private $endereco;
    private $descricao;
    private $cidade;
    private $vendas;

    /**
     * Evento constructor.
     * @param $id
     * @param $titulo
     * @param $subtitulo
     * @param $categoria
     * @param $banner
     * @param $preco
     * @param $data_criacao
     * @param $data_inicio
     * @param $duracao
     * @param $hora_inicio
     * @param $hora_termino
     * @param $endereco
     * @param $descriacao
     * @param $cidade
     * @param $vendas
     */
    public function __construct($id, $titulo = null, $subtitulo = null, $categoria = null, $banner = null, $preco = null, $data_criacao = null, $data_inicio = null, $duracao = null, $hora_inicio = null, $hora_termino = null, $endereco = null, $descriacao = null, $cidade = null, $vendas = null)
    {
        $this->id = intval($id);
        $this->titulo = htmlspecialchars(addslashes($titulo));
        $this->subtitulo = htmlspecialchars(addslashes($subtitulo));
        $this->categoria = htmlspecialchars(addslashes($categoria));
        $this->banner = htmlspecialchars(addslashes($banner));
        $this->preco = floatval($preco);
        $this->data_criacao = htmlspecialchars(addslashes($data_criacao));
        $this->data_inicio = htmlspecialchars(addslashes($data_inicio));
        $this->duracao = intval($duracao);
        $this->hora_inicio = htmlspecialchars(addslashes($hora_inicio));
        $this->hora_termino = htmlspecialchars(addslashes($hora_termino));
        $this->endereco = htmlspecialchars(addslashes($endereco));
        $this->descricao = htmlspecialchars(addslashes($descriacao));
        $this->cidade = htmlspecialchars(addslashes($cidade));
        $this->vendas = $vendas;
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
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = htmlspecialchars(addslashes($titulo));
    }

    /**
     * @return mixed
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * @param mixed $subtitulo
     */
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = htmlspecialchars(addslashes($subtitulo));
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = htmlspecialchars(addslashes($categoria));
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param mixed $banner
     */
    public function setBanner($banner)
    {
        $this->banner = htmlspecialchars(addslashes($banner));
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = floatval($preco);
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->data_criacao;
    }

    /**
     * @param mixed $data_criacao
     */
    public function setDataCriacao($data_criacao)
    {
        $this->data_criacao = htmlspecialchars(addslashes($data_criacao));
    }

    /**
     * @return mixed
     */
    public function getDataInicio()
    {
        return $this->data_inicio;
    }

    /**
     * @param mixed $data_inicio
     */
    public function setDataInicio($data_inicio)
    {
        $this->data_inicio = htmlspecialchars(addslashes($data_inicio));
    }

    /**
     * @return mixed
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * @param mixed $duracao
     */
    public function setDuracao($duracao)
    {
        $this->duracao = intval($duracao);
    }

    /**
     * @return mixed
     */
    public function getHoraInicio()
    {
        return $this->hora_inicio;
    }

    /**
     * @param mixed $hora_inicio
     */
    public function setHoraInicio($hora_inicio)
    {
        $this->hora_inicio = htmlspecialchars(addslashes($hora_inicio));
    }

    /**
     * @return mixed
     */
    public function getHoraTermino()
    {
        return $this->hora_termino;
    }

    /**
     * @param mixed $hora_termino
     */
    public function setHoraTermino($hora_termino)
    {
        $this->hora_termino = htmlspecialchars(addslashes($hora_termino));
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = htmlspecialchars(addslashes($endereco));
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = htmlspecialchars(addslashes($descricao));
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

    /**
     * @return mixed
     */
    public function getVendas()
    {
        return $this->vendas;
    }

    /**
     * @param mixed $vendas
     */
    public function setVendas($vendas)
    {
        $this->vendas = $vendas;
    }
}
