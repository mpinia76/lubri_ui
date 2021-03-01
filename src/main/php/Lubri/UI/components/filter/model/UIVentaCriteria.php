<?php
namespace Lubri\UI\components\filter\model;


use Lubri\UI\utils\LubriUIUtils;
use Lubri\Core\utils\LubriUtils;
use Lubri\Core\model\EstadoVenta;

use Lubri\UI\components\filter\model\UILubriCriteria;

use Rasty\utils\RastyUtils;
use Lubri\Core\criteria\VentaCriteria;

/**
 * Representa un criterio de búsqueda
 * para Ventas.
 *
 * @author Marcos
 * @since 13-03-2018
 *
 */
class UIVentaCriteria extends UILubriCriteria{

	/* constantes para los filtros predefinidos */
	const HOY = "ventasHoy";
	const SEMANA_ACTUAL = "ventasSemanaActual";
	const MES_ACTUAL = "ventasMesActual";
	const ANIO_ACTUAL = "ventasAnioActual";
	const IMPAGAS = "ventasImpagas";
	const ANULADAS = "ventasAnuladas";

	private $fechaDesde;

	private $fechaHasta;

	private $fecha;

	private $estados;

	private $estadoNotEqual;

	private $estado;

	private $cliente;

	private $observaciones;

	private $mes;

	private $year;

	private $user;

    private $marcaOPatente;

    /**
     * @return mixed
     */
    public function getMarcaOPatente()
    {
        return $this->marcaOPatente;
    }

    /**
     * @param mixed $marcaOPatente
     */
    public function setMarcaOPatente($marcaOPatente)
    {
        $this->marcaOPatente = $marcaOPatente;
    }

	public function __construct(){

		parent::__construct();

		//$this->setFiltroPredefinido( self::HOY );

	}

	protected function newCoreCriteria(){
		return new VentaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setFecha( $this->getFecha() );
		$criteria->setEstados( $this->getEstados() );
		$criteria->setEstado( $this->getEstado() );
		$criteria->setCliente( $this->getCliente() );
		$criteria->setObservaciones( $this->getObservaciones() );
		$criteria->setMes( $this->getMes() );
		$criteria->setYear( $this->getYear() );
		$criteria->setUser( $this->getUser() );
        $criteria->setMarcaOPatente( $this->getMarcaOPatente() );

		return $criteria;
	}



	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getEstados()
	{
	    return $this->estados;
	}

	public function setEstados($estados)
	{
	    $this->estados = $estados;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($cliente)
	{
	    $this->cliente = $cliente;
	}

	public function getCliente()
	{
	    return $this->cliente;
	}

	public function setCliente($cliente)
	{
	    $this->cliente = $cliente;
	}

	public function getUser()
	{
	    return $this->user;
	}

	public function setUser($user)
	{
	    $this->user = $user;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}


	public function ventasHoy(){

		$this->setFecha( new \Datetime() );

	}


	public function ventasSemanaActual(){

		$fechaDesde = LubriUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = LubriUtils::getLastDayOfWeek( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function ventasMesActual(){

		$fechaDesde = LubriUtils::getFirstDayOfMonth( new \Datetime() );
		$fechaHasta = LubriUtils::getLastDayOfMonth( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );

	}

	public function ventasAnioActual(){

		$fechaDesde = LubriUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = LubriUtils::getLastDayOfYear( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function ventasImpagas(){

		$this->setEstados( array(EstadoVenta::PagadaParcialmente,EstadoVenta::Impaga) );

	}

	public function ventasAnuladas(){

		$this->setEstado( EstadoVenta::Anulada );
	}

	public function getMes()
	{
	    return $this->mes;
	}

	public function setMes($mes)
	{
	    $this->mes = $mes;
	}

	public function getYear()
	{
	    return $this->year;
	}

	public function setYear($year)
	{
	    $this->year = $year;
	}

}
