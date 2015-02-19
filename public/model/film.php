<?php
class Film{
    private $id;
	private $titolo;
	private $autore;
	private $prezzo;
	private $trama;
	private $durata;
    private $quantita;

    public function __construct($i,$t,$a,$tr,$p,$d,$q) {
            $this->id = $i;
              $this->titolo = $t;
              $this->autore = $a;
              $this->trama = $tr;
              $this->prezzo = $p;
              $this->durata = $d;
            $this->quantita = $q;

              return true;
    }
    
            public function getTitolo(){
                    return $this->titolo;
            }
            public function getID(){
                    return $this->id;
            }
            public function getQuantita(){
                 return $this->quantita;
             }
            public function getAutore(){
                return $this->autore;
            }
            public function getPrezzo(){
                return $this->prezzo;
            }
            public function getDurata(){
                return $this->durata;
            }
            public function getTrama(){
                return $this->trama;
            }

  }
  
?>