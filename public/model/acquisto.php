<?php

class Acquisto {
    private $id;
    private $titolofilm;
    private $idA;
    private $idF;
    private $ts;
    private $acquirente;

    public function getNomeAcquirente()
    {
        return $this->acquirente;
    }

    public function setNomeAcquirente($n){
        $this->acquirente = $n;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getTitolo()
    {
        return $this->titolofilm;
    }

    public function getIdA()
    {
        return $this->idA;
    }

    public function getIdF()
    {
        return $this->idF;
    }

    public function getTs()
    {
        return $this->ts;
    }

    public function __construct($id,$idA,$idF,$ts,$titolo) {
        $this->id = $id;
        $this->idA = $idA;
        $this->idF = $idF;
        $this->ts = $ts;
        $this->titolofilm = $titolo;

        return true;
    }





}