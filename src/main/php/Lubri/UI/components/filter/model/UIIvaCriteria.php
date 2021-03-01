<?php
namespace Lubri\UI\components\filter\model;


use Lubri\UI\components\filter\model\UILubriCriteria;

use Rasty\utils\RastyUtils;
use Lubri\Core\criteria\IvaCriteria;

/**
 * Representa un criterio de búsqueda
 * para ivas.
 *
 * @author Marcos
 * @since 06/03/2018
 *
 */
class UIIvaCriteria extends UILubriCriteria{


	private $nombre;


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
		return new IvaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );

		return $criteria;
	}

}
