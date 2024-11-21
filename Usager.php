<?php
    class Usager {
        private $login;
        private $sexe;
        private $date_inscription;
        private $date_fin_abonnement;
        private $nom;
        private $prenom;
        private $ddn;
        private $ville;
        private $profession;
        private $situation;
        private $description;
        private $informations;
        private $profil;

        public function __construct($login, $sexe, $date_inscription, $date_fin_abonnement, $nom, $prenom, $ddn, $ville, $profession, $situation, $description, $informations, $profil) {
            $this->login = $login;
            $this->sexe = $sexe;
            $this->date_inscription = $date_inscription;
            $this->date_fin_abonnement = $date_fin_abonnement;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->ddn = $ddn;
            $this->ville = $ville;
            $this->profession = $profession;
            $this->situation = $situation;
            $this->description = $description;
            $this->informations = $informations;
            $this->profil = $profil;
        }

        public function getLogin() {
            return $this->login;
        }
        
        public function getSexe() {
            return $this->sexe;
        }

        public function getDateInscription() {
            return $this->date_inscription;
        }
        

        public function getDateFinAbonnement() {
            return $this->date_fin_abonnement;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function getDdn() {
            return $this->ddn;
        }

        public function getVille() {
            return $this->ville;
        }

        public function getProfession() {
            return $this->profession;
        }

        public function getSituation() {
            return $this->situation;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getInformations() {
            return $this->informations;
        }

        public function getProfil() {
            return $this->profil;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function setSexe($sexe) {
            $this->sexe = $sexe;
        }

        public function setDateInscription($date_inscription) {
            $this->date_inscription = $date_inscription;
        }

        public function setDateFinAbonnement($date_fin_abonnement) {
            $this->date_fin_abonnement = $date_fin_abonnement;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }

        public function setDdn($ddn) {
            $this->ddn = $ddn;
        }

        public function setVille($ville) {
            $this->ville = $ville;
        }

        public function setProfession($profession) {
            $this->profession = $profession;
        }

        public function setSituation($situation) {
            $this->situation = $situation;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function setInformations($informations) {
            $this->informations = $informations;
        }

        public function setProfil($profil) {
            $this->profil = $profil;
        }

        public function __toString() {
            return "Login : " . $this->login . ", Sexe : " . $this->sexe . ", Date d'inscription : " . $this->date_inscription . ", Date de fin d'abonnement : " . $this->date_fin_abonnement . ", Nom : " . $this->nom . ", Prénom : " . $this->prenom . ", Date de naissance : " . $this->ddn . ", Ville : " . $this->ville . ", Situation : " . $this->situation . ", Description : " . $this->description . ", Informations : " . $this->informations . ", Profil : " . $this->profil;
        }

        public function afficher() {
            echo $this->__toString();
        }
    }
?>