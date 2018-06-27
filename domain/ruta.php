<?php
class ruta{

	private $IdRuta;
	private $PuntoInicial;
	private $PuntoFinal;
	private $Tiempo;
	private $Distancia;
	private $TipoCamino;

	function ruta($IdRuta, $PuntoInicial, $PuntoFinal, $Tiempo, $Distancia, $TipoCamino){
		$this->IdRuta = $IdRuta;
		$this->PuntoInicial = $PuntoInicial;
		$this->PuntoFinal = $PuntoFinal;
		$this->Tiempo = $Tiempo;
		$this->Distancia = $Distancia;
		$this->TipoCamino = $TipoCamino;
	}//builder

	//sets y gets
	public function getIdRuta(){
		return $this->IdRuta;
	}
	public function setIdRuta($IdRuta){
		$this->IdRuta = $IdRuta;
	}

	public function getPuntoInicial(){
		return $this->PuntoInicial;
	}
	public function setPuntoInicial($PuntoInicial){
		$this->PuntoInicial = $PuntoInicial;
	}

	public function getPuntoFinal(){
		return $this->PuntoFinal;
	}
	public function setPuntoFinal($){
		$this->PuntoFinal = $PuntoFinal;
	}

	public function getTiempo(){
		return $this->Tiempo;
	}
	public function setTiempo($Tiempo){
		$this->Tiempo = $Tiempo;
	}

	public function getDistancia(){
		return $this->Distancia;
	}
	public function setDistancia($Distancia){
		$this->Distancia = $Distancia;
	}

	public function getTipoCamino(){
		return $this->TipoCamino;
	}
	public function setTipoCamino($TipoCamino){
		$this->TipoCamino = $TipoCamino;
	}

	//sets y gets

}//end class


?>