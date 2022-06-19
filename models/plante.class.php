
<?php
class Vegetal
    {
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/ 
        private $idVegetal;
        private $nomVegetal;
        private $infosVegetal;
        private $plantationVegetal;
        private $imageVegetal;
        private $idFamilleVegetal;
        /*-----------------------------------------------------
                            Constucteur :
        -----------------------------------------------------*/        
        public function __construct($idVegetal, $nomVegetal, $infosVegetal, $plantationVegetal, $imageVegetal, $idFamilleVegetal)
        {   
            $this->idVegetal = $idVegetal;
            $this->nomVegetal = $nomVegetal;
            $this->infosVegetal = $infosVegetal;
            $this->plantationVegetal = $plantationVegetal;
            $this->imageVegetal = $imageVegetal;
            $this->idFamilleVegetal = $idFamilleVegetal;
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

        public function getIdFamilleVegetal(){return $this->idFamilleVegetal;}
        public function setIdFamilleVegetal($newIdFamilleVegetal){$this->idFamilleVegetal = $newIdFamilleVegetal;}
    }



