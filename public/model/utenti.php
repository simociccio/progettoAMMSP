<?php
    class User{
        private $user;
        private $role;
        private $nomeCompleto;
        
        public function __construct($u,$r,$nc) {
            $this->user = $u;
            $this->role = $r;
            $this->nomeCompleto = $nc;
            
            return true;
        }
        
        public function getNomeCompleto(){
            return $this->nomeCompleto;
        }

        public function getRole() {
            return $this->role;
        }

        public function stampaUser(){
           echo $this->nomeCompleto;
           echo $this->role;
           echo $this->user;
       }
    }