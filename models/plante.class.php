
<?php

class Vegetal
    {
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/ 
        private $idVegetal;
        private $nomVegetal;
        private $infosVegetal;
        private $imageVegetal;
        private $plantationVegetal;
        /*-----------------------------------------------------
                            Constucteur (vide):
        -----------------------------------------------------*/        
        public function __construct($idVegetal, $nomVegetal, $infosVegetal,$plantationVegetal, $imageVegetal)
        {   
            $this->idVegetal = $idVegetal;
            $this->nomVegetal = $nomVegetal;
            $this->infosVegetal = $infosVegetal;
            $this->plantationVegetal = $plantationVegetal;
            $this->imageVegetal = $imageVegetal;
        }
        /*-----------------------------------------------------
                        Getter and Setter :
        -----------------------------------------------------*/

        public function getIdVegetal(){return $this->idVegetal;}
        public function setIdVegetal($newIdVegetal){$this->idVegetal = $newIdVegetal;}

        public function getNomVegetal(){return $this->nomVegetal;}
        public function setNomVegetal($newNomVegetal){$this->nomVegetal = $newNomVegetal;}

        public function getInfosVegetal(){return $this->infosVegetal;}
        public function setinfosVegetal($newInfosVegetal){$this->infosVegetal = $newInfosVegetal;}

        public function getPlantationVegetal(){return $this->plantationVegetal;}
        public function setPlantationVegetal($newPlantationVegetal){$this->plantationVegetal = $newPlantationVegetal;}

        public function getImageVegetal(){return $this->imageVegetal;}
        public function setImageVegetal($newImageVegetal){$this->imageVegetal = $newImageVegetal;}
    }



