<?php

class Utilisateur
    {
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/ 
        private $idUtilisateur;
        private $nomUtilisateur;
        private $prenomUtilisateur;
        private $pseudoUtilisateur;
        private $mailUtilisateur;
        private $mdpUtilisateur;
        private $droitUtilisateur;
        /*-----------------------------------------------------
                            Constucteur (vide):
        -----------------------------------------------------*/        
        public function __construct($idUtilisateur, $nomUtilisateur, $prenomUtilisateur, $pseudoUtilisateur, $mailUtilisateur, $mdpUtilisateur)
        {   
            $this->idUtilisateur = $idUtilisateur;
            $this->nomUtilisateur = $nomUtilisateur;
            $this->prenomUtilisateur = $prenomUtilisateur;
            $this->pseudoUtilisateur = $pseudoUtilisateur;
            $this->mailUtilisateur = $mailUtilisateur;
            $this->mdpUtilisateur = $mdpUtilisateur;
            /* $this->droitUtilisateur = $droitUtilisateur;   */
        }
        /*-----------------------------------------------------
                        Getter and Setter :
        -----------------------------------------------------*/
        //id_utilisateur Getter and Setter
        public function getIdUtilisateur()
        {
            return $this->idUtilisateur;
        }
        public function setIdUtilisateur($newIdUtilisateur)
        {
            $this->idUtilisateur = $newIdUtilisateur;
        }
        //nom_utilisateur Getter and Setter
        public function getNomUtilisateur()
        {
            return $this->nomUtilisateur;
        }
        public function setNomUtilisateur($newNomUtilisateur)
        {
            $this->nomUtilisateur = $newNomUtilisateur;
        }
        //prenom_utilisateur Getter and Setter
        public function getprenomUtilisateur()
        {
            return $this->prenomUtilisateur;
        }
        public function setprenomUtilisateur($newprenomUtilisateur)
        {
            $this->prenomUtilisateur = $newprenomUtilisateur;
        }
        //pseudo_user Getter and Setter
        public function getPseudoUtilisateur()
        {
            return $this->pseudoUtilisateur;
        }
        public function setPseudoUtilisateur($newPseudoUtilisateur)
        {
            $this->pseudoUtilisateur = $newPseudoUtilisateur;
        }
        //mail_utilisateur Getter and Setter
        public function getMailUtilisateur()
        {
            return $this->mailUtilisateur;
        }
        public function setMailUtilisateur($newMailUtilisateur)
        {
            $this->mailUtilisateur = $newMailUtilisateur;
        }

        //mdp_utilisateur Getter and Setter
        public function getMdpUtilisateur()
        {
            return $this->mdpUtilisateur;
        }
        public function setMdpUtilisateur($newMdpUtilisateur)
        {
            $this->mdpUtilisateur = $newMdpUtilisateur;
        }
        //droit Getter and Setter
        public function getDroit()
        {
            return $this->droitUtilisateur;
        }
        public function setDroit($newDroitUtilisateur)
        {
            $this->droitUtilisateur = $newDroitUtilisateur;
        }
    }