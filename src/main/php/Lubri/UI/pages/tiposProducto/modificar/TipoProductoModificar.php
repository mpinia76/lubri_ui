<?php
namespace Lubri\UI\pages\tiposProducto\modificar;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Lubri\Core\model\TipoProducto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class TipoProductoModificar extends LubriPage{

	/**
	 * tipoProducto a modificar.
	 * @var TipoProducto
	 */
	private $tipoProducto;


	public function __construct(){

		//inicializamos el tipoProducto.
		$tipoProducto = new TipoProducto();
		$this->setTipoProducto($tipoProducto);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setTipoProductoOid($oid){

		//a partir del id buscamos el tipoProducto a modificar.
		$tipoProducto = UIServiceFactory::getUITipoProductoService()->get($oid);

		$this->setTipoProducto($tipoProducto);

	}

	public function getTitle(){
		return $this->localize( "tipoProducto.modificar.title" );
	}

	public function getType(){

		return "TipoProductoModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getTipoProducto(){

	    return $this->tipoProducto;
	}

	public function setTipoProducto($tipoProducto)
	{
	    $this->tipoProducto = $tipoProducto;
	}
}
?>
