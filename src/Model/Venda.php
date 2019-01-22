<?php

class Venda
{
    private $id;
    private $data_venda;
    private $data_confirmacao;
    private $pulseira;
    private $participante;
    private $eventoId;
    private $checkin;

    /**
     * Venda constructor.
     * @param $id
     * @param $data_venda
     * @param $data_confirmacao
     * @param $pulseira
     * @param $participante
     * @param $eventoId
     * @param $checkin
     */
    public function __construct($id, $data_venda, $data_confirmacao, $pulseira, $participante, $eventoId, $checkin = false)
    {
        $this->id = intval($id);
        $this->data_venda = htmlspecialchars(addslashes($data_venda));
        $this->data_confirmacao = htmlspecialchars(addslashes($data_confirmacao));
        $this->pulseira = htmlspecialchars(addslashes($pulseira));
        $this->participante = $participante;
        $this->eventoId = intval($eventoId);
        $this->checkin = intval($checkin);
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
    public function getDataVenda()
    {
        return $this->data_venda;
    }

    /**
     * @param mixed $data_venda
     */
    public function setDataVenda($data_venda)
    {
        $this->data_venda = htmlspecialchars(addslashes($data_venda));
    }

    /**
     * @return mixed
     */
    public function getDataConfirmacao()
    {
        return $this->data_confirmacao;
    }

    /**
     * @param mixed $data_confirmacao
     */
    public function setDataConfirmacao($data_confirmacao)
    {
        $this->data_confirmacao = htmlspecialchars(addslashes($data_confirmacao));
    }

    /**
     * @return mixed
     */
    public function getPulseira()
    {
        return $this->pulseira;
    }

    /**
     * @param mixed $pulseira
     */
    public function setPulseira($pulseira)
    {
        $this->pulseira = htmlspecialchars(addslashes($pulseira));
    }

    /**
     * @return mixed
     */
    public function getParticipante()
    {
        return $this->participante;
    }

    /**
     * @param mixed $participante
     */
    public function setParticipante($participante)
    {
        $this->participante = $participante;
    }

    /**
     * @return mixed
     */
    public function getEventoId()
    {
        return $this->eventoId;
    }

    /**
     * @param mixed $eventoId
     */
    public function setEventoId($eventoId)
    {
        $this->eventoId = intval($eventoId);
    }

    /**
     * @return mixed
     */
    public function getCheckin()
    {
        return $this->checkin;
    }

    /**
     * @param mixed $checkin
     */
    public function setCheckin($checkin)
    {
        $this->checkin = intval($checkin);
    }


}