<?php
class Film{
	private $titolo;
	private $autore;
	private $prezzo;
	private $trama;
	private $durata;


    public function __construct($t,$a,$tr,$p,$d) {
              $this->titolo = $t;
              $this->autore = $a;
              $this->trama = $tr;
              $this->prezzo = $p;
              $this->durata = $d;

              return true;
    }
    
            public function getTitolo(){
                    return $this->titolo;
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