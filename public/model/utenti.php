<?php
    class User{
        private $id;
        private $user;
        private $role;
        private $nomeCompleto;
        
        public function __construct($id,$u,$r,$nc) {
            $this->id = $id;
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

        public function getID() {
            return $this->id;
        }

        public function stampaUser(){
           echo $this->nomeCompleto;
           echo $this->role;
           echo $this->user;
       }
    }