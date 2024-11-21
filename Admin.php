<?php
    class Admin {
        private $login;
        private $profil;
        
        public function __construct($login) {
            $this->login = $login;
            $this->profil = "admin";
        }

        public function getLogin() {
            return $this->login;
        }

        public function getProfil() {
            return $this->profil;
        }

        public function afficher() {
            echo "Login: " . $this->login . "<br>";
            echo "Profil: " . $this->profil . "<br>";
        }
    }
?>