<?php
namespace Lubri\UI\components\filter\model;


use Lubri\UI\components\filter\model\UILubriCriteria;

use Rasty\utils\RastyUtils;
use Lubri\Core\criteria\ClienteCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 *
 * @author Marcos
 * @since 02/03/2018
 *
 */
class UIClienteCriteria extends UILubriCriteria{


	private $nombre;
	private $documento;
	private $tieneCtaCte;

	public function __construct(){

		parent::__construct();

	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}


	protected function newCoreCriteria(){
		return new ClienteCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );
		$criteria->setDocumento( $this->getDocumento() );
		$criteria->setTieneCtaCte( $this->getTieneCtaCte() );

		return $criteria;
	}


	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}

	public function getTieneCtaCte()
	{
	    return $this->tieneCtaCte;
	}

	public function setTieneCtaCte($tieneCtaCte)
	{
	    $this->tieneCtaCte = $tieneCtaCte;
	}
}
