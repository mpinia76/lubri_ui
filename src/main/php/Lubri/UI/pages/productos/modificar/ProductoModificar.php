<?php
namespace Lubri\UI\pages\productos\modificar;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Lubri\Core\model\Producto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ProductoModificar extends LubriPage{

	/**
	 * producto a modificar.
	 * @var Producto
	 */
	private $producto;


	public function __construct(){

		//inicializamos el producto.
		$producto = new Producto();
		$this->setProducto($producto);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setProductoOid($oid){

		//a partir del id buscamos el producto a modificar.
		$producto = UIServiceFactory::getUIProductoService()->get($oid);

		$this->setProducto($producto);

	}

	public function getTitle(){
		return $this->localize( "producto.modificar.title" );
	}

	public function getType(){

		return "ProductoModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getProducto(){

	    return $this->producto;
	}

	public function setProducto($producto)
	{
	    $this->producto = $producto;
	}
}
?>
