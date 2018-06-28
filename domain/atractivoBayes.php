<?php
    class atractivoBayes {
        private $IdAtractivo;
        private $NombreAtractivo;
        private $DescripcionAtractivo;
        private $ImagenAtractivo;
        private $VideoAtractivo;
        private $LatitudAtractivo;
        private $LongitudAtractivo;
        private $TipoCaminoAtractivo;
        private $Duracion;
        private $Distancia;


        function atractivoBayes($IdAtractivo, $NombreAtractivo, $DescripcionAtractivo, $ImagenAtractivo,
        $VideoAtractivo, $LongitudAtractivo, $LatitudAtractivo, $TipoCaminoAtractivo, $Distancia, $Duracion){
            $this->IdAtractivo = $IdAtractivo;
            $this->NombreAtractivo = $NombreAtractivo;
            $this->DescripcionAtractivo = $DescripcionAtractivo;
            $this->ImagenAtractivo = $ImagenAtractivo;
            $this->VideoAtractivo = $VideoAtractivo;
            $this->LongitudAtractivo = $LongitudAtractivo;
            $this->LatitudAtractivo = $LatitudAtractivo;
            $this->TipoCaminoAtractivo = $TipoCaminoAtractivo;
            $this->Duracion = $Duracion;
            $this->Distancia = $Distancia;
        }//atractivo

        /*GET*/
        public function getIdAtractivo()
        {
            return $this->IdAtractivo;
        }

        public function getNombreAtractivo()
        {
            return $this->NombreAtractivo;
        }

        public function getDescripcionAtractivo()
        {
            return $this->DescripcionAtractivo;
        }

        public function getImagenAtractivo()
        {
            return $this->ImagenAtractivo;
        }

        public function getVideoAtractivo()
        {
            return $this->VideoAtractivo;
        }

        public function getLongitudAtractivo()
        {
            return $this->LongitudAtractivo;
        }

        public function getLatitudAtractivo()
        {
            return $this->LatitudAtractivo;
        }

        public function getTipoCaminoAtractivo()
        {
            return $this->TipoCaminoAtractivo;
        }

        public function getDuracion()
        {
            return $this->Duracion;
        }

        public function getDistancia()
        {
            return $this->Distancia;
        }

        /*SET*/
        public function setIdAtractivo($IdAtractivo)
        {
            $this->IdAtractivo = $IdAtractivo;
        }

        public function setNombreAtractivo($NombreAtractivo)
        {
            $this->NombreAtractivo = $NombreAtractivo;
        }

        public function setDescripcionAtractivo($DescripcionAtractivo)
        {
            $this->DescripcionAtractivo = $DescripcionAtractivo;
        }

        public function setImagenAtractivo($ImagenAtractivo)
        {
            $this->ImagenAtractivo = $ImagenAtractivo;
        }

        public function setVideoAtractivo($VideoAtractivo)
        {
            $this->VideoAtractivo = $VideoAtractivo;
        }

        public function setLongitudAtractivo($LongitudAtractivo)
        {
            $this->LongitudAtractivo = $LongitudAtractivo;
        }

        public function setLatitudAtractivo($LatitudAtractivo)
        {
            $this->LatitudAtractivo = $LatitudAtractivo;
        }

        public function setTipoCaminoAtractivo($TipoCaminoAtractivo)
        {
            $this->TipoCaminoAtractivo = $TipoCaminoAtractivo;
        }

        public function setDuracion($Duracion)
        {
            return $this->Duracion = $Duracion;
        }

        public function setDistancia($Distancia)
        {
            return $this->Distancia = $Distancia;
        }
    }//clase
?>