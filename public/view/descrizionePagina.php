<?php
class PageDescriptor{
    private $titolo;
    private $subview;
    private $errormessage;
    private $islogged;
    private $userName;
    private $nomeCompleto;
    private $titoloFilm;
    private $role;

    public function getRole() {
        return $this->role;
    }
    public function setRole($_r) {
        $this->role = $_r;
    }

    public function isLogged() {
        return $this->islogged;
    }
    public function setIsLogged($b)
                    {
                     $this->islogged = $b;
                    }
                    public function setUserName($_u){
                        $this->userName = $_u;
                    }
                    
                     public function setNomeCompleto($_nc){
                        $this->nomeCompleto = $_nc;
                    }
    
    
    public function setTitoloFilm($_t){
                        $this->titoloFilm = $_t;
                    }
    
public function setTitolo($inTitolo) {
        $this->titolo = $inTitolo;
    }

   	public function getTitolo() {
        return $this->titolo;
    }
       	public function getUserInfo() {
                   if ($this->islogged) {
            return "Benvenuto, " . $this->nomeCompleto . ".";
        } else {
            return "";
        }
    }
    
     

    public function setSubView($nomeView){
    	$this->subview = $nomeView;
    }

    public function getSubView() {
     	return $this->subview;

    }

    public function iError(){
        if(isset($this->errormessage)) return true;
        return false;
    }
    public function setErrorMessage($inErrorMessage) {
        $this->errormessage = $inErrorMessage;
    }

    public function getErrorMessage() {
        return $this->errormessage;
    }

    public function getUtenteLoggato(){

        return "";
    
    }
        
    
}

?>